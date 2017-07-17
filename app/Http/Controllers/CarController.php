<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\ValidatedCarRequest;
use App\Entities\Car;
use App\Repositories\Contracts\CarRepositoryInterface;


class CarController extends Controller
{

    private $carsRepository;

    public function __construct(CarRepositoryInterface $carsRepository)
    {
        $this->carsRepository = $carsRepository;
    }

    /**
     * Show list of items from repository
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $cars = $this->carsRepository->getAll();
        $carsFiltered = array();

        foreach ($cars as $car) {
            array_push($carsFiltered, [
                'color' => $car->getColor(),
                'id' => $car->getId(),
                'model' => $car->getModel(),
                'year' => $car->getYear(),
                'price' => $car->getPrice()
            ]);
        }

        return view('cars/index', ['cars' => $carsFiltered]);
    }

    /**
     * Show the form for creating a new resource
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('cars/create');
    }

    /**
     * Show specified item
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $car = $this->carsRepository->getById($id);

        if (is_object($car)) {
            $response = view('cars/show', ['car' => $car->toArray()]);
        } else {
            $response = view('errors/404');
        }

        return $response;
    }

    /**
     * edit specified item
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $car = $this->carsRepository->getById($id);

        return view('cars/edit', ['car' => $car->toArray()]);
    }

    /**
     * Update item values
     *
     * @param ValidateCarRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function update(ValidatedCarRequest $request, int $id)
    {
        $requiredFields = $request->only([
            'model', 'year', 'registration_number', 'color', 'price'
        ]);

        $car = $this->carsRepository->getById($id);

        if (is_object($car)) {
            $car->fromArray($requiredFields);
            $this->carsRepository->update($car);

            $response = view('cars/show', ['car' => $car->toArray()]);
        } else {
            $response = view('errors/404');
        }

        return $response;
    }

    /**
     * Update item values
     *
     * @param ValidateCarRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(ValidatedCarRequest $request)
    {
        $requiredFields = $request->only([
            'model', 'year', 'registration_number', 'color', 'price'
        ]);
        
        $newCar = new Car($requiredFields);
        $this->carsRepository->store($newCar);

        $cars = $this->carsRepository->getAll();

        return view('cars/index', ['cars' => $cars->toArray()]);
    }

    /**
     * destroy specified item
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function destroy(int $id)
    {
        $car = $this->carsRepository->getById($id);
        $collection = $this->carsRepository->delete($id);
        if (is_object($car)) {
            $response = view('cars/index', ['cars' => $cars->toArray()]);
        } else {
            $response = view('errors/404');
        }

        return $response;
    }
}
