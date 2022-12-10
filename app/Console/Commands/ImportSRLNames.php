<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportSRLNames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mfh:importsrlnames';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // load contact.csv from storage
        $file = fopen(storage_path("app/contact.csv"), "r");
        $headers = fgetcsv($file);
        $data = [];
        while (($row = fgetcsv($file)) !== false) {
            $data[] = array_combine($headers, $row);
        }
        fclose($file);

        // update users by matching challonge name
        foreach ($data as $row) {
            $user = \App\Models\User::where("challonge_username", $row["Challonge Username"])->first();
            if ($user) {
                $user->srl_username = $row["SRL username"];
                $user->save();
            }
        }


        return 0;
    }
}
