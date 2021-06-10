<?php
/**
 * Das Model "Example" implementiert alle grundlegenden Funktionen einer Datenbank-
 * Anwendung: load (SELECT), save (INSERT oder UPDATE) und delete (DELETE).
 */
class GeneralModel
{
	public int $id = 0;
	public string $name = '';

	/**
	 * create() initialisiert alle Eigenschaften des Objekts
	 * Für neue Datensätze kann die $id auf 0 gesetzt werden.
	 */
	public function create(int $id, string $name): ?self
	{
		$this->id = $id;
		$this->name = $name;
		return $this;
	}

	/**
	 * Datensatz mit gegebener ID von der Datenbank ins Objekt laden
	 */
	public function load(string $table, int $id): ?self
	{
		$statement = db()->prepare('SELECT * FROM ' . $table . ' WHERE id = :id LIMIT 1');
		$statement->bindParam(':id', $id);
		$statement->execute();
		$result = $statement->fetch();

		if ($result) {
			// Datensatz gefunden? Eigenschaften setzen und Objekt zurückgeben.
			$this->id = $result['id'];
			$this->name = $result['name'];
			return $this;

		} else {
			// Datensatz NICHT gefunden? null zurückgeben.
			return null;
		}
	}

	/**
	 * Alle Datensätze von Tabelle (welche eine Bedingung erfüllen) von der Datenbank laden
	 */
	public function getAll(string $table, string $whereCondition = ''): array
    {
	    $db = db();
		$queryString = 'SELECT * FROM '. $table . ' ' . ($whereCondition?('WHERE ' . $whereCondition):'');

        $statement = $db->prepare($queryString);
        $statement->execute();

        return $statement->fetchAll();
	}

	/**
	 * Speichere die Daten des aktuellen Objektes in die Datenbank (INSERT oder UPDATE)
	 */
	public function save(): int
	{
		$db = db();

		if (!$this->id) {
			// Neuer Datensatz einfügen (INSERT)
			$statement = db()->prepare('INSERT...');
			// Dein Code ...

			// Neuer Datensatz? Setze die neue ID
			$this->id = $db->lastInsertId();

	} else {
			// Bestehender Datensatz aktualisieren (UPDATE)
			$statement = db()->prepare('UPDATE...');
			// Dein Code ...
		}

		// Gib die Anzahl der gespeicherten Datensätze zurück (1 = Erfolg, 0 = Fehler)
		return $statement->rowCount();
	}

	/**
	 * Lösche einen Datensatz, entweder mit der angegebenen $id oder falls nicht angegeben, der aktuell geladene.
	 */
	public function delete(int $id = 0): int
	{
        $db = db();
        $statement = $db->prepare("");

		// Falls keine $id angegeben ist, lösche den aktuell geladenen ($this->id) des Objektes.
		if ($id == 0) {
			$id = $this->id;
		}

		if ($id > 0) {
			// Datensatz löschen (DELETE)
			// Dein Code ...
			
			// Gib die Anzahl der gespeicherten Datensätze zurück (1 = Erfolg, 0 = Fehler)
			return $statement->rowCount();
		} else {
			return 0;
		}
	}
}
