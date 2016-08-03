<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * List all users action
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return response()->json(['data' => ['users' => User::all()]]);
    }

    public function view($id)
    {
        try {
            /** @var User $user */
            $user = User::find($id);
            if (!$user) {
                throw new \Exception('User not found', 404);
            }
            $user->verified = verifyUserId($user->id);

            return response()->json(['data' => ['user' => $user]]);
        } catch (\Exception $e) {
            $statusCode = $e->getCode() ? : 500;
            return response()
                ->json(['errors' => [['message' => $e->getMessage(), 'status' => $statusCode]]])
                ->setStatusCode($statusCode);
        }
    }

    /**
     * Save a user from request params
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        try {
            $user = User::create($request->all());

            return response()->json(['data' => ['user' => $user]])->setStatusCode(201);
        } catch (\Exception $e) {
            $statusCode = $e->getCode() ? : 500;
            return response()
                ->json(['errors' => [['message' => $e->getMessage(), 'status' => $statusCode]]])
                ->setStatusCode($statusCode);
        }
    }

    /**
     * Update an user by it's id
     *
     * @param Request $request
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $id)
    {
        try {
            /** @var User $user */
            $user = User::find($id);
            if (!$user) {
                throw new \Exception('User not found', 404);
            }
            $user->fill($request->all());
            $user->save();

            return response()->json(['data' => ['user' => $user]]);
        } catch (\Exception $e) {
            $statusCode = $e->getCode() ? : 500;
            return response()
                ->json(['errors' => [['message' => $e->getMessage(), 'status' => $statusCode]]])
                ->setStatusCode($statusCode);
        }
    }

    /**
     * Delete an user by it's id
     *
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete($id)
    {
        try {
            User::destroy($id);

            return response(null, 204);
        } catch (\Exception $e) {
            $statusCode = $e->getCode() ? : 500;
            return response()
                ->json(['errors' => [['message' => $e->getMessage(), 'status' => $statusCode]]])
                ->setStatusCode($statusCode);
        }
    }
}
