<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Services\POFBackend;
use App\Activity;

class SynchronizeWithPOF extends Job implements SelfHandling {

    protected $pof;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(POFBackend $pof) {
        $this->pof = $pof;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        $tree = $this->pof->getFullTree();
        foreach ($tree['program'][0]['agegroups'] as $agegroup) {
            $age = strtolower($agegroup['title']);
            $this->extractTasks($agegroup, $age);
        }
    }

    protected function extractTasks($object, $agegroup) {
        if (isset($object['tasks'])) {
            foreach($object['tasks'] as $task)
            {
                //dd($object);
                Activity::updateOrCreate(['guid' => $task['guid'], 'name' => $task['title'],'task_group' => $object['title'] ,'age_group' => $agegroup]);
            }
        }
        if (isset($object['taskgroups'])) {
            foreach ($object['taskgroups'] as $taskgroup) {
                $this->extractTasks($taskgroup, $agegroup);
            }
        }
    }

}
