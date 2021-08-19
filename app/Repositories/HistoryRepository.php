<?php

namespace App\Repositories;

use App\Models\History;

class HistoryRepository
{
    private $history;

    public function __construct($history = null)
    {
        $this->history = $history ?? new History();
    }

    public function fetch(array $data)
    {
        $histories = $this->history::with('user')->paginate(15);
        return $histories;
    }

    public function store(array $data)
    {
        $history = $this->history;
        $history->entity = $data['entity'];
        $history->action = $data['action'];
        $history->data = $data['data'];
        $history->user_id = $data['user_id'];
        $history->save();

        return $history;
    }
}
