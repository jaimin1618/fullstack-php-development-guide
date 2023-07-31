<?php

class Item extends DB {
	protected static $table = 'items';
	protected static $columns = [
		'id',
		'name',
		'price',
		'category',
		'image_addr',
		'description',
		'chef_name',
		'rating',
	];
	protected $errors = [];

	// properties
	public $id;
	public $name = '';
	public $price = '';
	public $category = '';
	public $image_addr = '';
	public $description = '';
	public $chef_name = '';
	public $rating = '';

	private const RATING_OPTIONS = [
		1 => 'No taste!',
		2 => 'Ok',
		3 => 'Delicious',
		4 => 'Superb',
		5 => 'Perfect'
	];

	public function __construct(array $args = []) {
		$this->name = $args['name'] ?? '';
		$this->price = $args['price'] ?? 0.0;
		$this->category = $args['category'] ?? '';
		$this->image_addr = $args['image_addr'] ?? '';
		$this->description = $args['description'] ?? '';
		$this->chef_name = $args['chef_name'] ?? '';
		$this->rating = $args['rating'] ?? 0;
	}

	public function display_rating(): string {
		return self::RATING_OPTIONS[$this->rating];
	}

	public function display_price(): string {
		return '$' . number_format($this->price, 2);
	}

	public static function all() {
		$items = parent::all();

		foreach ($items as $item) {
			$item->price = $item->display_price();
			$item->rating = $item->display_rating();
		}

		return $items;
	}

  public function validate() {
    $this->errors = [];
    $props = $this->properties();

    if (!preg_match('/[a-zA-Z0-9]{8}/', $props['name'])) {
      $this->errors[] = "Name must contain at least one alpha-numeric charcter of A-Z|a-z|0-9 and Name must be 7 or more than 7 characters long";
    }

    if (!is_float($props['price'] || !is_int($props['price']))) {
      $this->errors[] = "Price must be float or integer type";
    }

    if (is_string($props['category']) && preg_match('/[A-Za-z\d\s]/g', $props['category'])) {
      $this->errors[] = "Category can only contain A-Z|a-z and spaces";
    }

    $image = $props['image_addr'];
    $items = explode('.', $image);
    $ext = $items[sizeof($items) - 1];
    $allowed_ext = ['.jpg', 'jpeg', '.png', '.svg', 'gif'];

    if (!in_array($ext, $allowed_ext)) {
      $this->errors[] = "Allowed files types: jpg, jpeg, png, gif, svg";
    }

    if (!preg_match('/^[a-zA-z]+([\s][a-zA-Z]+)*$/', $props['chef_name'])) {
      $this->errors[] = "Chef name must contain at least one alphabetic charcters of A-Z|a-z & one space";
    }

    if (!($props['rating'] > 0 && $props['rating'] <= 5)) {
      $this->errors[] = "Rating must be an integer from 1 to 5";
    } 

    return $this->errors;
  }

  public function getValidationErrors () {
    return $this->errors;
  }
}
