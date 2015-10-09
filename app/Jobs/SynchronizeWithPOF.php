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
        $tasks = [];
        $tree = $this->pof->getFullTree();
        foreach ($tree['program'][0]['agegroups'] as $agegroup) {
            $tasks = array_merge($tasks, $this->extractTasks($agegroup));
        }
                
        foreach ($tasks as $task) {    
            Activity::updateOrCreate(['guid' => $task['guid']],['name' => $task['title']]);
        }
    }

    protected function extractTasks($object) {
        $tasks = [];
        if (isset($object['tasks'])) {
            $tasks = array_merge($tasks, $object['tasks']);
        }
        if (isset($object['taskgroups'])) {
            foreach ($object['taskgroups'] as $taskgroup) {
                $tasks = array_merge($tasks, $this->extractTasks($taskgroup));
            }
        }
        return $tasks;
    }

}
