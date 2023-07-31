<?php

class DB {
	static protected $database;
	static protected $columns = [];
	static protected $table = '';
	protected $errors = [];

	// utilities
	/**
	 * set database
	 */
	public static function set_database(mysqli $db) {
		self::$database = $db;
	}

	/**
	 * run query by sql
	 */
	public static function run_query(string $sql) {
		$result = self::$database->query($sql);
		if (!$result) {
			exit("Database query failed");
		}

		// convert result into object
		$objects = [];
		while ($row = $result->fetch_assoc()) {
			$objects[] = static::dataToModel($row);
		}

		$result->free();
		return $objects;
	}

	/**
	 * convert raw data to model object
	 */
	private static function dataToModel(array $raw_data) {
		$object = new static;
		foreach ($raw_data as $property => $value) {
			if (property_exists($object, $property)) {
				$object->$property = $value;
			}
		}

		return $object;
	}

	/**
	 * getting models properties from columns
	 * i.e Car->wheels and etc.
	 */
	public function properties() {
		$props = [];
		foreach (static::$columns as $col) {
			if ($col === 'id') {
				continue;
			}
			$props[$col] = $this->$col;
		}
		return $props;
	}

	/**
	 * setting input arguments as object properties
	 */
	public function set_properties(array $args = []) {
		foreach ($args as $prop => $val) {
			if (property_exists($this, $prop) && !is_null($val)) {
				$this->$prop = $val;
			}
		}
	}

	/**
	 * sanitization of input data
	 */
	public function sanitize() {
		$sanitized = [];
		foreach ($this->properties() as $k => $v) {
			$sanitized[$k] = self::$database->escape_string($v);
		}
		return $sanitized;
	}

	/**
	 * CRUD
	 */
	public static function all() {
		$sql = "SELECT * FROM " . static::$table . ";";
		return static::run_query($sql);
	}

	public static function find(int $id) {
		$sql = sprintf(
			"SELECT * FROM %s WHERE id=%d LIMIT 1;",
			static::$table,
			self::$database->escape_string($id)
		);
		$objects = static::run_query($sql);
		if (!empty($objects)) {
			return array_shift($objects); // return first
		}
		return false;
	}

	protected function create() {
		$this->validate();
		if (!empty($this->errors)) {
			return false;
		}

		$attr = $this->sanitize();
		$sql = sprintf(
			"INSERT INTO %s (%s) VALUES ('%s');",
			static::$table,
			join(", ", array_keys($attr)),
			join("', '", array_values($attr))
		);

		$result = self::$database->query($sql);
		// print_r(self::$database->error);

		if ($result) {
			$this->id = self::$database->insert_id;
			return $this->id;
		}

		return $result;
	}

	protected function update() {
		$this->validate();
		if (!empty($this->errors)) {
			return false;
		}

		$attr = $this->sanitize();
		$attr_pairs = [];
		foreach ($attr as $k => $v) {
			$attr_pairs[] = "{$k}='{$v}'";
		}

		$sql = sprintf(
			"UPDATE %s SET %s WHERE id=%d LIMIT 1",
			static::$table,
			join(', ', $attr_pairs),
			self::$database->escape_string($this->id)
		);

		$result = self::$database->query($sql);
		if ($result) {
			return $this->id;
		}

		return $result;
	}

	public function save() {
		if (isset($this->id)) {
			return $this->update();
		}
		return $this->create();
	}

	public function delete(int $id) {
		$sql = sprintf(
			"DELETE FROM %s WHERE id=%d LIMIT 1",
			static::$table,
			self::$database->escape_string($id)
		);
		$result = self::$database->query($sql);
		return $result;
	}

	public function validate() {
		$this->errors = [];
		// stuff...

		return $this->errors;
	}
}
