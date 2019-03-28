<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(){

    }
    public function bone()
    {


        $cars = $this->getDbData(0, 130);
        $bikes = $this->getDbData(130, 130);
        $computers = $this->getDbData(260, 130);
        $drinks = $this->getDbData(390, 130);
        $foods = $this->getDbData(520, 130);
        $furniture = $this->getDbData(650, 130);
        $phones = $this->getDbData(780, 130);
        $hotels = $this->getDbData(910, 130);
        $shirts = $this->getDbData(1040, 130);
        $template = $this->getDbData(1170, 130);

        $car_images = $this->getImages('cars');
        $bike_images = $this->getImages('bikes');
        $computer_images = $this->getImages('computers');
        $drinks_images = $this->getImages('drinks');
        $foods_images = $this->getImages('foods');
        $furniture_images = $this->getImages('furniture');
        $hotels_images = $this->getImages('hotels');
        $phones_images = $this->getImages('phones');
        $shirts_images = $this->getImages('shirts');
        $templates_images = $this->getImages('templates');

        $this->insertIntoDb($cars, $car_images, "Cars", 1);
        $this->insertIntoDb($bikes, $bike_images, "Bikes", 2);
        $this->insertIntoDb($computers, $computer_images, "Computers", 3);
        $this->insertIntoDb($drinks, $drinks_images, "Drinks", 4);
        $this->insertIntoDb($foods, $foods_images, "Foods", 5);
        $this->insertIntoDb($furniture, $furniture_images, "Furniture", 6);
        $this->insertIntoDb($phones, $phones_images, "Phones", 7);
        $this->insertIntoDb($hotels, $hotels_images, "Hotels", 8);
        $this->insertIntoDb($shirts, $shirts_images, "Shirts", 9);
        $this->insertIntoDb($template, $templates_images, "Templates", 10);

    }

    public function insertIntoDb($data, $images, $name, $cat_id)
    {
        if (count($data) == count($images)) {
//            echo "Count equal for " . $name . "<br>";
            for ($i = 0; $i < count($data); $i++) {
                $data[$i]->image = $images[$i];
                $data[$i]->cat_id = $cat_id;
                $data[$i]->update();
            }
        } else {
            echo "Count not equal for " . $name . "<br>";
        }
    }

    public function getDbData($start, $end)
    {
        $endy = $start + $end;
        return Product::where("id", ">", $start)->where("id", "<=", $endy)->get();
    }

    public function getImages($name)
    {
        $ary = [];
        $file = public_path("files/" . $name . ".txt");
        if ($file = fopen($file, "r")) {
            while (!feof($file)) {
                $line = fgets($file);
                array_push($ary, $line);
            }
            fclose($file);
        }
        return $ary;
    }
}
