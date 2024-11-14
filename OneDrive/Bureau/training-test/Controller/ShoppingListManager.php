<?php

class ShoppingListManager
{

    private $notificationService;
    private $items = [];

    public function __construct($notificationService)
   {
   
    $this->notificationService = $notificationService;

   }

    



public function addItem($item)
{

    if (empty($item['name'])){
        throw new InvalidArgumentException("Item name is required");
    }
    if ($item['priority'] === 'high'){
        $this->notificationService->sendNotification("New high-priority item added to you shopping list");
    }
    return true;
}

public function updateItem($itemId, $itemData)
{
    if (isset($this->items[$itemId])) {
        $this->items[$itemId] = $itemData;
        return true;
    }
}


    




    public function deletItem($itemId)
    {
        if (isset($this->items[$itemId])) {
            unset($this->items[$itemId]);
            $this->items = array_values($this->items);
            return true;
        }
    
}

    

}

