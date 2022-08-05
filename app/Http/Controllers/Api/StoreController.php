<?php

namespace App\Http\Controllers\Api;

use App\Repository\StoreRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;

class StoreController extends Controller
{
    private $storeRepository;

    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => $this->storeRepository->getAll()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email')
            ];

            $this->storeRepository->create($data);

            $response = [true, 'Loja cadastrada com sucesso.', 200];
        } catch(\Exception $e) {
            $response = [false, 'Erro ao cadastrar loja.', 500];
        }

        return response()->json(['success' => $response[0], 'msg' => $response[1]], $response[2]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'data' => $this->storeRepository->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, $id)
    {
        try {
            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email')
            ];
            
            $this->storeRepository->update($id, $data);

            $response = [true, 'Loja editada com sucesso.', 200];
        } catch(\Exception $e) {
            $response = [false, 'Erro ao editar loja.', 500];
        }

        return response()->json(['success' => $response[0], 'msg' => $response[1]], $response[2]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->storeRepository->delete($id);

            $response = [true, 'Loja removida com sucesso.', 200];
        } catch(\Exception $e) {
            $response = [false, 'Erro ao remover loja.', 500];
        }

        return response()->json(['success' => $response[0], 'msg' => $response[1]], $response[2]);
    }
}
