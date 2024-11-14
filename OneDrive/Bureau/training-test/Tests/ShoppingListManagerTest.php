 <?php
 use PHPUnit\Framework\TestCase;

 class ShoppingListManagerTest extends TestCase
{
public function testAddItemWithoutNameThrowsException()
 {
 $mockNotificationService = $this->createMock(NotificationService::class);
 $shoppingListManager = new ShoppingListManager($mockNotificationService);

 $this->expectException(InvalidArgumentException::class);
 $shoppingListManager->addItem(['name' => '']);
 }

 public function testAddHighPriorityItemSendsNotification()
 {
 $mockNotificationService = $this->createMock(NotificationService::class);
 $mockNotificationService->expects($this->once())
 ->method('sendNotification')
 ->with("New high-priority item added to your shopping list");

 $shoppingListManager = new ShoppingListManager($mockNotificationService);

 $shoppingListManager->addItem(['name' => 'Urgent item', 'priority' => 'high']);
 }

 public function testDeleteItem()
 {
 $mockNotificationService = $this->createMock(NotificationService::class);
 $shoppingListManager = new ShoppingListManager($mockNotificationService);

 $shoppingListManager->addItem(['name' => 'Test Item']);
 $this->assertTrue($shoppingListManager->deleteItem (0));
 }
}