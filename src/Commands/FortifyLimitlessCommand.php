<?php

namespace Vanthao03596\FortifyLimitless\Commands;

use Illuminate\Console\Command;

class FortifyLimitlessCommand extends Command
{
    public $signature = 'fortify-limitless';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
