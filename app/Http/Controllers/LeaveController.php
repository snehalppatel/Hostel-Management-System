<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Models\Admin;
use App\Models\Leave;
use App\Models\User;
use App\Notifications\ChangeLeaveStatus;
use App\Notifications\LeaveRequestCreate;
use App\Repositories\LeaveRepository;
use Flash;
use Illuminate\Http\Request;
use Response;

class LeaveController extends AppBaseController
{
    /** @var  LeaveRepository */
    private $leaveRepository;

    public function __construct(LeaveRepository $leaveRepo)
    {
        $this->leaveRepository = $leaveRepo;
    }

    /**
     * Display a listing of the Leave.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if(isSecurity()){
            abort(404);
        }
        $user = \Auth::user();
        // dd($user);
        $leaves = Leave::orderBy('id','desc')->get();
        // $leaves = Leave::has('user')->where('user_id', $user->id)->get();

        return view('leaves.index')
            ->with('leaves', $leaves);
    }

    public function allLeaves(Request $request)
    {
        // $user = \Auth::user();
        // // dd($user);
        // $leaves = $this->leaveRepository->all();
        $leaves = Leave::has('user')->with('user')->get();

        return view('leaves.all_index')
            ->with('leaves', $leaves);
    }    

    /**
     * Show the form for creating a new Leave.
     *
     * @return Response
     */
    public function create()
    {
        return view('leaves.create');
    }

    /**
     * Store a newly created Leave in storage.
     *
     * @param CreateLeaveRequest $request
     *
     * @return Response
     */
    public function store(CreateLeaveRequest $request)
    {
        $user = \Auth::user();
        $startDate = \Carbon::parse($request->start_date)->format('Y-m-d');
        // dd($startDate);
        $betweendate = Leave::where('user_id', $user->id)->whereDate('start_date','<=', $startDate)
            ->whereDate('end_date','>=', $startDate)->get();
            // dd($betweendate);
        if($betweendate && count($betweendate) > 0){
            Flash::error('Leave request already exist for this date!');
            return redirect()->back()->withInput();
        }

        $input = $request->all();

        $leave = $this->leaveRepository->create($input);

            // dd($user->full_name);
        $data['message']="New Leave request send by ". $user->full_name." for approval!"; 
        $data['leave_id']=$leave->id;         

        // send notification to all warden
        $wardens = User::where('type', 'Warden')->get();
        foreach ($wardens as $key => $warden) {
                $warden->notify(new LeaveRequestCreate($data));
        }

        Flash::success('Leave request send successfully to hostel warden!');

        return redirect(route('leaves.index'));
    }

    /**
     * Display the specified Leave.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $leave = $this->leaveRepository->find($id);

        if (empty($leave)) {
            Flash::error('Leave not found');

            return redirect(route('leaves.index'));
        }

        return view('leaves.show')->with('leave', $leave);
    }

    /**
     * Show the form for editing the specified Leave.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $leave = $this->leaveRepository->find($id);

        if (empty($leave)) {
            Flash::error('Leave not found');

            return redirect(route('leaves.index'));
        }

        return view('leaves.edit')->with('leave', $leave);
    }

    /**
     * Update the specified Leave in storage.
     *
     * @param int $id
     * @param UpdateLeaveRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $leave = $this->leaveRepository->find($id);

        // check if update the status than send notifcation
        if (empty($leave)) {
            Flash::error('Leave not found');

            return redirect(route('leaves.index'));
        }

        $leave = $this->leaveRepository->update($request->all(), $id);
        if($request->has('update_status') && $request->update_status ==1){
            $user = User::find($leave->user_id);

        $data['message']="You leave has been ". $leave->status." by Warden"; 
        $data['leave_id']=$leave->id;    

            $user->notify(new ChangeLeaveStatus($data));
        }

        Flash::success('Leave updated successfully.');

        return redirect(route('leaves.index'));
    }

    /**
     * Remove the specified Leave from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $leave = $this->leaveRepository->find($id);

        if (empty($leave)) {
            Flash::error('Leave not found');

            return redirect(route('leaves.index'));
        }

        $this->leaveRepository->delete($id);

        Flash::success('Leave deleted successfully.');

        return redirect(route('leaves.index'));
    }
}
