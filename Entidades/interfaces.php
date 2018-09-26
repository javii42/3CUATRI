<?php

interface IArchivo{
    public function GuardarEnArchivo($nombreDeArchivo);
    public function TraerDeArchivo($nombreDeArchivo);
}