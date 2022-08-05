<?php

namespace App\Http\Controllers\Api;

use App\Repository\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

use App\Mail\ProductMail;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{

    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'data' => $this->productRepository->getAll()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $data = [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'active' => $request->input('status'),
                'stores_id' => $request->input('stores_id'),
            ];

            $this->productRepository->create($data);
            
            // envia notificação
            if(env('APP_ENV') == 'production') {
                try {
                    Mail::to('para@email.com', 'Nome')->send(new ProductMail($data, 'Novo produto cadastrado'));
                } catch(\Exception $e) {
                    //echo  $e->getMessage();
                }
            }

            $response = [true, 'Produto cadastrado com sucesso.', 200];
        } catch(\Exception $e) {
            $response = [false, 'Erro ao cadastrar produto. '.$e->getMessage(), 500];
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
            'data' => $this->productRepository->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            $data = [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'active' => $request->input('status'),
                'stores_id' => $request->input('stores_id'),
            ];
            
            $this->productRepository->update($id, $data);

            // envia notificação
            if(env('APP_ENV') == 'production') {
                try {
                    Mail::to('para@email.com', 'Nome')->send(new ProductMail($data, 'Novo produto cadastrado'));
                } catch(\Exception $e) {
                    //echo  $e->getMessage();
                }
            }

            $response = [true, 'Produto editado com sucesso.', 200];
        } catch(\Exception $e) {
            $response = [false, 'Erro ao editar produto.', 500];
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
            $this->productRepository->delete($id);

            $response = [true, 'Produto removido com sucesso.', 200];
        } catch(\Exception $e) {
            $response = [false, 'Erro ao remover produto.', 500];
        }

        return response()->json(['success' => $response[0], 'msg' => $response[1]], $response[2]);
    }
}
