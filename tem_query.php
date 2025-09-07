<?php
    define('DataFile', 'data.json');

    function saveData(array $inputData) {
        file_put_contents(DataFile, json_encode($inputData, JSON_PRETTY_PRINT));
    }

    function loadData() {
        if (!file_exists(DataFile)) {
            return [];
        }
        $data = file_get_contents(DataFile);
        return $data ? json_decode($data, true) : [];
    }

    $inputData = loadData();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Add Task
        if (isset($_POST["inputData"]) && !empty($_POST["inputData"])) {
            $inputData[] = [
                "inputData" => htmlspecialchars(trim($_POST["inputData"])),
                "bool"      => false
            ];
            saveData($inputData);
            header("Location: " . $_SERVER["PHP_SELF"]);
            exit;
        }

        // Delete Task
        if (isset($_POST["delete"])) {
            unset($inputData[$_POST["delete"]]);
            $inputData = array_values($inputData);
            saveData($inputData);
            header("Location: " . $_SERVER["PHP_SELF"]);
            exit;
        }

        // Toggle Task
        if (isset($_POST["toggle"])) {
            $index = $_POST["toggle"];
            $inputData[$index]["bool"] = !$inputData[$index]["bool"];
            saveData($inputData);
            header("Location: " . $_SERVER["PHP_SELF"]);
            exit;
        }
    }
?>