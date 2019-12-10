<?php

header('conten-type: application/json');
echo json_encode(['time' => time(), 'date' => date('d.m.Y'), 'tech' => 'ZEIT Now']);
