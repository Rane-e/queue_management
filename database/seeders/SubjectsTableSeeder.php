<?

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsTableSeeder extends Seeder
{
    public function run()
    {
        Subject::create(['name' => 'Subject One']);
        Subject::create(['name' => 'Subject Two']);
        Subject::create(['name' => 'Subject Three']);
    }
}
