<?php

namespace Boy132\UserCreatableServers\Models;

use App\Models\Egg;
use App\Models\Objects\DeploymentObject;
use App\Models\Server;
use App\Models\User;
use App\Services\Servers\ServerCreationService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property User $user
 * @property int $user_id
 * @property int $memory
 * @property int $disk
 * @property int $cpu
 * @property ?int $server_limit
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class UserResourceLimits extends Model
{
    protected $fillable = [
        'user_id',
        'memory',
        'disk',
        'cpu',
        'server_limit',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getMemoryLeft(): ?int
    {
        if ($this->memory > 0) {
            $sum_memory = $this->user->servers->sum('memory');

            return $this->memory - $sum_memory;
        }

        return null;
    }

    public function getDiskLeft(): ?int
    {
        if ($this->disk > 0) {
            $sum_disk = $this->user->servers->sum('disk');

            return $this->disk - $sum_disk;
        }

        return null;
    }

    public function getCpuLeft(): ?int
    {
        if ($this->cpu > 0) {
            $sum_cpu = $this->user->servers->sum('cpu');

            return $this->cpu - $sum_cpu;
        }

        return null;
    }

    public function canCreateServer(int $memory, int $disk, int $cpu): bool
    {
        if ($this->server_limit && $this->user->servers->count() + 1 > $this->server_limit) {
            return false;
        }

        if ($this->memory > 0) {
            if ($memory <= 0) {
                return false;
            }

            $sum_memory = $this->user->servers->sum('memory');
            if ($sum_memory + $memory > $this->memory) {
                return false;
            }
        }

        if ($this->disk > 0) {
            if ($disk <= 0) {
                return false;
            }

            $sum_disk = $this->user->servers->sum('disk');
            if ($sum_disk + $disk > $this->disk) {
                return false;
            }
        }

        if ($this->cpu > 0) {
            if ($cpu <= 0) {
                return false;
            }

            $sum_cpu = $this->user->servers->sum('cpu');
            if ($sum_cpu + $cpu > $this->cpu) {
                return false;
            }
        }

        return true;
    }

    public function createServer(string $name, int|Egg $egg, int $memory, int $disk, int $cpu): Server|bool
    {
        if ($this->canCreateServer($memory, $disk, $cpu)) {
            if (!$egg instanceof Egg) {
                $egg = Egg::findOrFail($egg);
            }

            $environment = [];
            foreach ($egg->variables as $variable) {
                $environment[$variable->env_variable] = $variable->default_value;
            }

            $data = [
                'name' => $name,
                'owner_id' => $this->user_id,
                'egg_id' => $egg->id,
                'cpu' => $cpu,
                'memory' => $memory,
                'disk' => $disk,
                'swap' => 0,
                'io' => 500,
                'environment' => $environment,
                'skip_scripts' => false,
                'start_on_completion' => true,
                'oom_killer' => false,
                'database_limit' => config('usercreatableservers.database_limit'),
                'allocation_limit' => config('usercreatableservers.allocation_limit'),
                'backup_limit' => config('usercreatableservers.backup_limit'),
            ];

            $object = new DeploymentObject();
            $object->setDedicated(false);
            $object->setTags(['user_creatable_servers']);
            $object->setPorts([]);

            /** @var ServerCreationService $service */
            $service = app(ServerCreationService::class); // @phpstan-ignore-line

            return $service->handle($data, $object);
        }

        return false;
    }
}
