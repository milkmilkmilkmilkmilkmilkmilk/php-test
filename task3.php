<?php

/**
 * Ищет файлы в папке datafiles, имена которых состоят из цифр и букв латинского алфавита,
 * и имеют расширение .ixt.
 *
 * @return void
 */
function findFiles() {
    $directory = __DIR__ . '/datafiles'; // Используем __DIR__ для получения текущей директории скрипта

    // Проверяем, существует ли директория
    if (!is_dir($directory)) {
        echo "Директория не найдена: $directory" . PHP_EOL;
        return;
    }

    // Получаем список файлов в директории
    $files = scandir($directory);
    $matchingFiles = [];

    // Проходим по каждому файлу в директории
    foreach ($files as $file) {
        // Проверяем, что файл соответствует регулярному выражению
        if (preg_match('/^[a-zA-Z0-9]+.(ixt)$/', $file)) {
            $matchingFiles[] = $file; // Добавляем файл в массив, если он подходит
        }
    }

    // Сортируем файлы по имени
    sort($matchingFiles);

    // Проверяем, есть ли найденные файлы
    if (empty($matchingFiles)) {
        echo "Нет файлов, соответствующих критериям." . PHP_EOL;
    } else {
        // Выводим найденные файлы
        foreach ($matchingFiles as $file) {
            echo $file . PHP_EOL; // Выводим имя файла
        }
    }
}

// Запускаем функцию поиска файлов
findFiles();
