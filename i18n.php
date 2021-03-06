<?php
return [
    'languages' => [
        'us',
        'th',
    ], /* Add languages to the array for the language files to be generated. */
  
    'except' => [
        '.git',
        '.gitignore',
        '.gitkeep',
        '.hgignore',
        '.hgkeep',
        '.svn',
        '/messages',
        '/vendor',
    ],/*  exclude file */
    'format' => 'php',
    'messagePath' => __DIR__ . DIRECTORY_SEPARATOR .  'messages',
    'only' => ['*.php'],
    'overwrite' => true,
    'removeUnused' => false,
    'sort' => true,
    'sourcePath' => __DIR__. DIRECTORY_SEPARATOR,
    'translator' => 'Yii::t'
];