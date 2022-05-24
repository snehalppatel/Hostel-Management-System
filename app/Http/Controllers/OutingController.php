<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateOutingRequest;
use App\Http\Requests\UpdateOutingRequest;
use App\Models\Outing;
use App\Models\User;
use App\Notifications\LeaveRequestCreate;
use App\Notifications\OutingRequestCreate;
use App\Repositories\OutingRepository;
use Flash;
use Illuminate\Http\Request;
use Response;

class OutingController extends AppBaseController
{
    /** @var  OutingRepository */
    private $outingRepository;

    public function __construct(OutingRepository $outingRepo)
    {
        $this->outingRepository = $outingRepo;
    }

    /**
     * Display a listing of the Outing.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $user = \Auth::user();
        // $outings = $this->outingRepository->all();
        if (isStudent()) {
            $outings = Outing::has('user')->where('user_id', $user->id)->orderBy('id', 'desc')->get();
        } else {
            $outings = Outing::has('user')->orderBy('id', 'desc')->get();
        }
        return view('outings.index')
            ->with('outings', $outings);
    }

    public function allOuting()
    {
        $user = \Auth::user();
        // $outings = $this->outingRepository->all();
        $outings = Outing::has('user')->with('user')->get();
        return view('outings.admin_view')
            ->with('outings', $outings);
    }

    /**
     * Show the form for creating a new Outing.
     *
     * @return Response
     */
    public function create()
    {
        if (isWarden()) {
            // dd("sdfsdf");
            Flash::error('Permission denied!');
            return redirect()->back();
        }
        return view('outings.create');
    }

    /**
     * Store a newly created Outing in storage.
     *
     * @param CreateOutingRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $user  = \Auth::user();

        // if ($request->has('roll_number')) {
        //     $this->validate($request, [
        //         'roll_number' => 'required|exists:users',
        //     ]);
        // }
        // in time will be added by security guard and outtime will be enter by stuent
        if (isset($input['in_time'])) {
            $datetime         = $input['in_time'];
            $datetime         = explode(" ", $datetime);
            $input['in_time'] = $datetime[1];
            $input['in_date'] = \Carbon::parse($datetime[0]);
        }

        if (isset($input['out_time'])) {
            $datetime = $input['out_time'];
            $datetime = explode(" ", $datetime);
            // dd($datetime);
            $input['out_time'] = $datetime[1];
            $input['out_date'] = \Carbon::parse($datetime[0]);
        }

        /// store data if outing done by security or warden
        if (isStudent()) {
            $input['user_id'] = $user->id;
        } else {
            // find the user from roll number
            $getuser = User::whereNotNull('roll_number')->where('roll_number', $request->roll_number)->first();

            $input['security_id'] = $user->id;
            $input['user_id']     = $getuser->id;

        }

        $outing = $this->outingRepository->create($input);

        /// @todo send outing notifictaion to warden and security if outing entry done by student
        if (isStudent()) {
            $user = \Auth::user();
            $outingTime = ($outing->out_date !=null)?\Carbon::parse($outing->out_date)->format('d-m-Y'):'- ';
            $outtime = ($outing->out_time !=null)?\Carbon::parse($outing->out_time)->format('g:i A'):'-';

            $data['message']   = "Outing has been created by " . $user->full_name." for ".$outingTime .' / ' .$outtime;
            $data['outing_id'] = $outing->id;

            $wardens = User::whereIn('type', ['Warden', 'Security'])->get();
            foreach ($wardens as $key => $warden) {
                $warden->notify(new OutingRequestCreate($data));
            }
        }

        Flash::success('Outing saved successfully.');

        return redirect(route('outings.index'));
    }

    /**
     * Display the specified Outing.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $outing = $this->outingRepository->find($id);

        if (empty($outing)) {
            Flash::error('Outing not found');

            return redirect(route('outings.index'));
        }

        return view('outings.show')->with('outing', $outing);
    }

    /**
     * Show the form for editing the specified Outing.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $outing = $this->outingRepository->find($id);

        if (empty($outing)) {
            Flash::error('Outing not found');

            return redirect(route('outings.index'));
        }

        return view('outings.edit')->with('outing', $outing);
    }

    /**
     * Update the specified Outing in storage.
     *
     * @param int $id
     * @param UpdateOutingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOutingRequest $request)
    {
        $outing = $this->outingRepository->find($id);

        if (empty($outing)) {
            Flash::error('Outing not found');

            return redirect(route('outings.index'));
        }
        $input = $request->all();

        // in time will be added by security guard and outtime will be enter by stuent
        if (isset($input['in_time'])) {
            $datetime         = $input['in_time'];
            $datetime         = explode(" ", $datetime);
            $input['in_time'] = $datetime[1];
            $input['in_date'] = \Carbon::parse($datetime[0]);
        }

        if (isset($input['out_time'])) {
            $datetime = $input['out_time'];
            $datetime = explode(" ", $datetime);
            // dd($datetime);
            $input['out_time'] = $datetime[1];
            $input['out_date'] = \Carbon::parse($datetime[0]);
        }


        /// store data if outing done by security or warden
        if (isStudent()) {
//            $input['user_id'] = $user->id;
        } else {
            // find the user from roll number
            // $getuser = User::whereNotNull('roll_number')->where('roll_number', $request->roll_number)->first();

            $input['security_id'] = \Auth::user()->id;
            // $input['user_id']     = $getuser->id;

        }


        $outing = $this->outingRepository->update($input, $id);

        /// @todo send outing notifictaion to warden and security if outing entry done by student
        if (isStudent()) {
            $user = \Auth::user();
            $outingTime = ($outing->out_date !=null)?\Carbon::parse($outing->out_date)->format('d-m-Y'):'- ';
            $outtime = ($outing->out_time !=null)?\Carbon::parse($outing->out_time)->format('g:i A'):'-';

            $data['message']   = "Outing has been created by " . $user->full_name." for ".$outingTime .' / ' .$outtime;
            $data['outing_id'] = $outing->id;

            $wardens = User::whereIn('type', ['Warden', 'Security'])->get();
            foreach ($wardens as $key => $warden) {
                $warden->notify(new OutingRequestCreate($data));
            }
        }

        Flash::success('Outing updated successfully.');

        return redirect(route('outings.index'));
    }

    /**
     * Remove the specified Outing from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $outing = $this->outingRepository->find($id);

        if (empty($outing)) {
            Flash::error('Outing not found');

            return redirect(route('outings.index'));
        }

        $this->outingRepository->delete($id);

        Flash::success('Outing deleted successfully.');

        return redirect(route('outings.index'));
    }
}
