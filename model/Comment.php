<?php

class Comment {
    private $idComment;
    private $idBillet;
    private $pseudo;
    private $comment;
    private $commentDate;
    private $status;
    private $report;
    private $answer;

    public function getIdComment() {
        return $this->idComment;
    }

    public function setIdComment($idComment) {
        $this->idComment = $idComment;
        return $this;
    }

    public function getIdBillet() {
        return $this->idBillet;
    }

    public function setIdBillet($idBillet) {
        $this->idBillet = $idBillet;
        return $this;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function getComment() {
        return $this->comment;
    }

    public function setComment($comment) {
        $this->comment = $comment;
        return $this;
    }

    public function getCommentDate() {
        return $this->commentDate;
    }

    public function setCommentDate($commentDate) {
        $this->commentDate = new DateTime($commentDate);
        return $this;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }
 
    public function getReport() {
        return $this->report;
    }

    public function setReport($report) {
        $this->report = $report;
        return $this;
    }

    public function getAnswer() {
        return $this->answer;
    }

    public function setAnswer($answer) {
        $this->answer = $answer;
        return $this;
    }


}