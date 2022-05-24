<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Student;


class ActiveateStudentByCourse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activate:students {--date=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will get students from Moodle, and check for student who has course is completed, if yes than those students will get activated in our systems';

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
         \Log::info("Cron is working fine!");
        $db_ext = \DB::connection('mysql_external');
        
            $students = Student::whereNotNull('moodle_user_id')->where('course_completed',0)->get();        
        foreach($students as $findUser){
            // $findUser = Student::where('moodle_user_id', $user->userid)->where('course_completed',0)->first();
            // if($findUser){
            //     $findUser->course_completed = 1;
            //     $findUser->save();                  
            //      \Log::info("Course completed by !". $findUser->first_name.' '.$findUser->last_name);                
            // }

            
            $moodelUser = $findUser->moodle_user_id;
            //dd($moodelUser);
            $getEnrolls = $db_ext->table('mdl_user_enrolments')
            //->select('mdl_course_modules.id')
            ->join('mdl_enrol','mdl_enrol.id','mdl_user_enrolments.enrolid')
            ->join('mdl_course_modules','mdl_course_modules.course','mdl_enrol.courseid')
            ->where('mdl_course_modules.completion', '!=', 0)->where('mdl_user_enrolments.userid', $moodelUser)->where('mdl_course_modules.deletioninprogress', 0)->pluck('mdl_course_modules.id')->toArray();
        //    dd($getEnrolls);
            $completion = 0;
            foreach($getEnrolls as $courseId){
                $course_completed = $db_ext->table('mdl_course_modules_completion')->where('coursemoduleid',$courseId)->where('completionstate',1)->first();
                if($course_completed){
                    $completion +=1;        
                }else{
                    $completion = 0;
                    break;
                }
            }
//            dd($completion);
            if($completion > 0){
        //        dd("sdfsdf");
                $findUser->course_completed = 1;
                $findUser->save();                  
                 \Log::info("Course completed by !". $findUser->first_name.' '.$findUser->last_name);                
            }    
        }
  //      $course_completed = $db_ext->table('mdl_course_modules_completion')->where('completionstate',1)->get();

        // foreach($course_completed as $user){
        //     $findUser = Student::where('moodle_user_id', $user->userid)->where('course_completed',0)->first();
        //     if($findUser){
        //         $findUser->course_completed = 1;
        //         $findUser->save();                  
        //          \Log::info("Course completed by !". $findUser->first_name.' '.$findUser->last_name);                
        //     }
        // }
        
//         $db_ext = \DB::connection('mysql_external');
// //        $values = array('auth' => 'manual','confirmed' => 1,'mnethostid'=>1, 'username'=>$input['username'], 'password'=>$password, 'firstname'=>$input['first_name'], 'lastname'=>$input['last_name'], 'email'=>$input['email']);

//         $countries = $db_ext->table('mdl_user')->get();
//         dd($countries);

        $this->info('Demo:Cron Cummand Run successfully!');         

        // $date = now()->format('Y-m-d');        
        // return 0;
    }
}