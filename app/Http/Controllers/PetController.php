<?php namespace App\Http\Controllers;

use App\Interfaces\PetRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

//import Pet Validator
use App\Http\Validators\PetValidator;

class PetController extends Controller 
{	
	private $petRepository;

    public function __construct(PetRepositoryInterface $petRepository){

        $this->petRepository = $petRepository;
    }

	public function index(Request $request): JsonResponse
	{
        // accept other query input for query params
		$offset = $request -> query('skip', 0);
		$limit = $request -> query('take', 12);
		$sorting = $request -> query('sort', '');
   
		// order initially empty
		$order_query = [];

		if($sorting != ''){

			$sort_query_arr = json_decode($sorting, true);

            // if the sorting is empty, then rebuild the selector
			if(!empty($sort_query_arr)){
				$order_query[$sort_query_arr[0]['selector']] = ($sort_query_arr[0]['desc']) ? 'desc' : 'asc';
			}
		}

		try {

			$data = $this->petRepository->getAllPets([
				'offset' => (int) $offset,
				'limit' => (int) $limit,
				'order' => $order_query
			]);

			if(!$data['records'] -> isEmpty()){

				$data = [
                    'response' => [
                        'data' => $data['records'],
                        'count' => $data['count'],
                        'message' => '',
                    ],
                    'code' => 200
				];

			}else{
                $data = [
                    'response' => [
                        'data' => [],
                        'message' => 'Empty Records'
                    ],
                    'code' => 200
                ];
            }

            return response()->json($data['response'], $data['code']);

		} catch (\Throwable $th) {

			return response()->json([
				'data' => [],
				'message' => $th -> getMessage()
			], 500);
		}
	}

	public function details(int $id, Request $request): JsonResponse
	{
		try {

			$records = $this->petRepository->getPetById($id);

			if($records){

				$data = [
                    'response' => [
                        'data' => $records,
                        'message' => '',
                    ],
                    'code' => 200
				];

			}else{
                $data = [
                    'response' => [
                        'data' => [],
                        'message' => 'Not found'
                    ],
                    'code' => 404
                ];
            }

			return response()->json($data['response'], $data['code']);

		} catch (\Throwable $th) {

			return response()->json([
				'data' => [],
				'message' => $th -> getMessage()
			], 500);

		}
	}

	public function create(Request $request, PetValidator $petValidator): JsonResponse
	{
		try {

            $validation = $petValidator -> validate_create($request);

			if ($validation -> fails()){

                $data = [
                    'response' => [
                        'data' => [],
                        'message' => $validation -> errors() -> first()
                    ],
                    'code' => 409
                ];

			}else{

                $create_pet = $this->petRepository->createPet([
                    'name' => sanitize_input($request -> input('name')),
                    'nickname' => sanitize_input($request -> input('nickname')),
                    'weight' => sanitize_input($request -> input('weight')),
                    'height' => sanitize_input($request -> input('height')),
                    'gender' => sanitize_input($request -> input('gender')),
                    'color' => sanitize_input($request -> input('color')),
                    'friendliness' => ($request->filled('friendliness')) ? sanitize_input($request -> input('friendliness')) : null,
                    'birthday' => sanitize_input($request -> input('birthday'))
                ]);
    
                if($create_pet -> exists){

                    $data = [
                        'response' => [
                            'data' => $create_pet,
                            'message' => 'create successful'
                        ],
                        'code' => 200
                    ];

                }else{

                    $data = [
                        'response' => [
                            'data' => [],
                            'message' => 'Failed to create, Please try again later'
                        ],
                        'code' => 409
                    ];
                }

            }

			return response()->json($data['response'], $data['code']);

		} catch (\Throwable $th) {

			return response()->json([
				'data' => [],
				'message' => $th -> getMessage()
			], 500);
		}
	}


	public function update(int $id, Request $request, PetValidator $petValidator): JsonResponse
	{
		try {

            // manually put the id parameter
            $request->request->add(['id' => $id]); 

            $validation = $petValidator -> validate_update($request);

			if ($validation -> fails()){

                $data = [
                    'response' => [
                        'data' => [],
                        'message' => $validation -> errors() -> first()
                    ],
                    'code' => 409
                ];
			}else{
                
                $update_pet = $this->petRepository->updatePet($id, [
                    'name' => sanitize_input($request -> input('name')),
                    'nickname' => sanitize_input($request -> input('nickname')),
                    'weight' => sanitize_input($request -> input('weight')),
                    'height' => sanitize_input($request -> input('height')),
                    'gender' => sanitize_input($request -> input('gender')),
                    'color' => sanitize_input($request -> input('color')),
                    'friendliness' => ($request->filled('friendliness')) ? sanitize_input($request -> input('friendliness')) : null,
                    'birthday' => sanitize_input($request -> input('birthday'))
                ]);

                if($update_pet){

                    $pet = $this->petRepository->getPetById($id);

                    $data = [
                        'response' => [
                            'data' => $pet,
                            'message' => 'update successful'
                        ],
                        'code' => 200
                    ];

                }else{

                    $data = [
                        'response' => [
                            'data' => [],
                            'message' => 'Failed to update, Please try again later'
                        ],
                        'code' => 409
                    ];
                }
            }

			return response()->json($data['response'], $data['code']);

		} catch (\Throwable $th) {

			return response()->json([
				'data' => [],
				'message' => $th -> getMessage()
			], 500);

		}
	}
}