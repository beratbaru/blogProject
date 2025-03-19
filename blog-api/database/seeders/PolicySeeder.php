<?php
namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    public function run()
    {
        Policy::create([
            'title' => 'kvkk',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum faucibus dui dignissim, bibendum metus ut, aliquam sem. Fusce rutrum lacinia sem, id suscipit sapien feugiat eu. Vivamus tincidunt diam ut enim laoreet euismod. Vestibulum volutpat ut tortor a hendrerit. Vivamus semper malesuada tempus. Curabitur ornare laoreet blandit. Donec rhoncus ac ex id commodo. Integer ultricies posuere odio, eget sollicitudin justo consectetur ut. Fusce eu erat luctus, aliquam dui eget, lobortis tellus. Aenean et placerat arcu. Nulla at ullamcorper turpis, eget efficitur orci. Nunc convallis erat tellus, ac aliquam turpis finibus quis. Etiam interdum augue sed bibendum porttitor. Suspendisse facilisis enim quis ex iaculis, placerat maximus tortor mattis..',
        ]);

        Policy::create([
            'title' => 'security',
            'content' => 'Mauris convallis orci id ultricies malesuada. Duis lacinia rhoncus ipsum, ac vehicula arcu imperdiet sed. Maecenas eget bibendum nulla. Sed fringilla feugiat lacus, eu dignissim est hendrerit sed. Mauris sagittis, tellus at venenatis accumsan, turpis leo dignissim elit, non feugiat dolor tellus quis turpis. Cras vel pellentesque velit. Ut malesuada molestie consectetur. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',

        ]);
        $this->command->info('Policies have been seeded.');
    }
}
