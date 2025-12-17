namespace App\Services;

use Illuminate\Support\Str;

class TokenService
{
    public function create(string $borgUser, int $hours, int $maxUses): array
    {
        return [
            'token' => Str::random(64),
            'borg_user' => $borgUser,
            'expires_at' => now()->addHours($hours),
            'max_uses' => $maxUses,
        ];
    }
}
