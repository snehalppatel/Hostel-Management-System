<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAdminAPIRequest;
use App\Http\Requests\API\UpdateAdminAPIRequest;
use App\Models\Admin;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AdminController
 * @package App\Http\Controllers\API
 */

class AdminAPIController extends AppBaseController
{
    /** @var  AdminRepository */
    private $adminRepository;

    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepository = $adminRepo;
    }

    /**
     * Display a listing of the Admin.
     * GET|HEAD /admins
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $admins = $this->adminRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($admins->toArray(), 'Admins retrieved successfully');
    }

    /**
     * Store a newly created Admin in storage.
     * POST /admins
     *
     * @param CreateAdminAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAdminAPIRequest $request)
    {
        $input = $request->all();

        $admin = $this->adminRepository->create($input);

        return $this->sendResponse($admin->toArray(), 'Admin saved successfully');
    }

    /**
     * Display the specified Admin.
     * GET|HEAD /admins/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Admin $admin */
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            return $this->sendError('Admin not found');
        }

        return $this->sendResponse($admin->toArray(), 'Admin retrieved successfully');
    }

    /**
     * Update the specified Admin in storage.
     * PUT/PATCH /admins/{id}
     *
     * @param int $id
     * @param UpdateAdminAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdminAPIRequest $request)
    {
        $input = $request->all();

        /** @var Admin $admin */
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            return $this->sendError('Admin not found');
        }

        $admin = $this->adminRepository->update($input, $id);

        return $this->sendResponse($admin->toArray(), 'Admin updated successfully');
    }

    /**
     * Remove the specified Admin from storage.
     * DELETE /admins/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Admin $admin */
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            return $this->sendError('Admin not found');
        }

        $admin->delete();

        return $this->sendSuccess('Admin deleted successfully');
    }
}
