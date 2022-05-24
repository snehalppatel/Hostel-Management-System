<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWardenRequest;
use App\Http\Requests\UpdateWardenRequest;
use App\Repositories\WardenRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class WardenController extends AppBaseController
{
    /** @var  WardenRepository */
    private $wardenRepository;

    public function __construct(WardenRepository $wardenRepo)
    {
        $this->wardenRepository = $wardenRepo;
    }

    /**
     * Display a listing of the Warden.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $wardens = $this->wardenRepository->all();

        return view('wardens.index')
            ->with('wardens', $wardens);
    }

    /**
     * Show the form for creating a new Warden.
     *
     * @return Response
     */
    public function create()
    {
        return view('wardens.create');
    }

    /**
     * Store a newly created Warden in storage.
     *
     * @param CreateWardenRequest $request
     *
     * @return Response
     */
    public function store(CreateWardenRequest $request)
    {
        $input = $request->all();

        $warden = $this->wardenRepository->create($input);

        Flash::success('Warden saved successfully.');

        return redirect(route('wardens.index'));
    }

    /**
     * Display the specified Warden.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $warden = $this->wardenRepository->find($id);

        if (empty($warden)) {
            Flash::error('Warden not found');

            return redirect(route('wardens.index'));
        }

        return view('wardens.show')->with('warden', $warden);
    }

    /**
     * Show the form for editing the specified Warden.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $warden = $this->wardenRepository->find($id);

        if (empty($warden)) {
            Flash::error('Warden not found');

            return redirect(route('wardens.index'));
        }

        return view('wardens.edit')->with('warden', $warden);
    }

    /**
     * Update the specified Warden in storage.
     *
     * @param int $id
     * @param UpdateWardenRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWardenRequest $request)
    {
        $warden = $this->wardenRepository->find($id);

        if (empty($warden)) {
            Flash::error('Warden not found');

            return redirect(route('wardens.index'));
        }

        $warden = $this->wardenRepository->update($request->all(), $id);

        Flash::success('Warden updated successfully.');

        return redirect(route('wardens.index'));
    }

    /**
     * Remove the specified Warden from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $warden = $this->wardenRepository->find($id);

        if (empty($warden)) {
            Flash::error('Warden not found');

            return redirect(route('wardens.index'));
        }

        $this->wardenRepository->delete($id);

        Flash::success('Warden deleted successfully.');

        return redirect(route('wardens.index'));
    }
}
