<?php
interface Functions {
    public function setId(int $id);
    public function getId(): int;
    public function checkFileName(): bool;
    public function showImage();
    public function showPassport();
}

?>