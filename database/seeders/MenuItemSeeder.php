<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $starters   = Category::where('name','Starters')->first();
        $salads     = Category::where('name','Salads')->first();
        $fastFood   = Category::where('name','Fast Food')->first();
        $mainCourse = Category::where('name','Main Course')->first();
        $breads     = Category::where('name','Breads')->first();
        $rice       = Category::where('name','Rice & Biryani')->first();
        $drinks     = Category::where('name','Drinks')->first();
        $desserts   = Category::where('name','Desserts')->first();

        $getImage = function($categoryName) {
            $urls = [
                'Starters' => 'https://images.unsplash.com/photo-1599487488170-d11ec9c172f0?w=400',
                'Salads'   => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=400',
                'Fast Food'=> 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400',
                'Main Course'=> 'https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=400',
                'Breads'   => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=400',
                'Rice & Biryani'=> 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8?w=400',
                'Drinks'   => 'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=400',
                'Desserts' => 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=400',
            ];
            return $urls[$categoryName] ?? 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400';
        };

        /* ---------- Starters ---------- */
        // ID 1: Paneer Tikka (Special + Top Selling)
        MenuItem::create(['category_id'=>$starters->id,'name'=>'Paneer Tikka','description'=>'Paneer cubes grilled','price'=>240, 'image'=>$getImage('Starters'), 'is_special'=>true, 'is_recommended'=>false, 'is_top_selling'=>true]);
        // ID 2: Chicken Tikka (Recommended)
        MenuItem::create(['category_id'=>$starters->id,'name'=>'Chicken Tikka','description'=>'Chicken grilled','price'=>260, 'image'=>$getImage('Starters'), 'is_special'=>false, 'is_recommended'=>true, 'is_top_selling'=>false]);
        // ID 3: Chilli Paneer
        MenuItem::create(['category_id'=>$starters->id,'name'=>'Chilli Paneer','description'=>'Spicy paneer','price'=>220, 'image'=>$getImage('Starters'), 'is_special'=>false, 'is_recommended'=>false, 'is_top_selling'=>false]);
        // ID 4: Veg Manchurian
        MenuItem::create(['category_id'=>$starters->id,'name'=>'Veg Manchurian','description'=>'Veg balls','price'=>200, 'image'=>$getImage('Starters'), 'is_special'=>false, 'is_recommended'=>false, 'is_top_selling'=>false]);
        // ID 5: Tandoori Chicken (Top Selling)
        MenuItem::create(['category_id'=>$starters->id,'name'=>'Tandoori Chicken','description'=>'Clay oven chicken','price'=>320, 'image'=>$getImage('Starters'), 'is_special'=>false, 'is_recommended'=>false, 'is_top_selling'=>true]);

        /* ---------- Salads ---------- */
        // ID 6-10: Sab Normal
        MenuItem::create(['category_id'=>$salads->id,'name'=>'Green Salad','description'=>'Fresh salad','price'=>70, 'image'=>$getImage('Salads')]);
        MenuItem::create(['category_id'=>$salads->id,'name'=>'Onion Salad','description'=>'Onion slices','price'=>60, 'image'=>$getImage('Salads')]);
        MenuItem::create(['category_id'=>$salads->id,'name'=>'Kachumber Salad','description'=>'Mixed veg','price'=>80, 'image'=>$getImage('Salads')]);
        MenuItem::create(['category_id'=>$salads->id,'name'=>'Sprouts Salad','description'=>'Healthy sprouts','price'=>90, 'image'=>$getImage('Salads')]);
        MenuItem::create(['category_id'=>$salads->id,'name'=>'Cucumber Salad','description'=>'Cucumber slices','price'=>75, 'image'=>$getImage('Salads')]);

        /* ---------- Fast Food ---------- */
        // ID 11: Veg Burger (Special + Top Selling)
        MenuItem::create(['category_id'=>$fastFood->id,'name'=>'Veg Burger','description'=>'Veg patty burger','price'=>120, 'image'=>$getImage('Fast Food'), 'is_special'=>true, 'is_recommended'=>false, 'is_top_selling'=>true]);
        // ID 12: Chicken Burger (Top Selling)
        MenuItem::create(['category_id'=>$fastFood->id,'name'=>'Chicken Burger','description'=>'Chicken patty','price'=>150, 'image'=>$getImage('Fast Food'), 'is_special'=>false, 'is_recommended'=>false, 'is_top_selling'=>true]);
        // ID 13: Paneer Sandwich (Recommended)
        MenuItem::create(['category_id'=>$fastFood->id,'name'=>'Paneer Sandwich','description'=>'Grilled sandwich','price'=>140, 'image'=>$getImage('Fast Food'), 'is_special'=>false, 'is_recommended'=>true, 'is_top_selling'=>false]);
        // ID 14-15: Normal
        MenuItem::create(['category_id'=>$fastFood->id,'name'=>'French Fries','description'=>'Crispy fries','price'=>110, 'image'=>$getImage('Fast Food')]);
        MenuItem::create(['category_id'=>$fastFood->id,'name'=>'Cheese Maggi','description'=>'Cheesy noodles','price'=>100, 'image'=>$getImage('Fast Food')]);

        /* ---------- Main Course ---------- */
        // ID 16: Paneer Butter Masala (Top Selling)
        MenuItem::create(['category_id'=>$mainCourse->id,'name'=>'Paneer Butter Masala','description'=>'Creamy paneer','price'=>300, 'image'=>$getImage('Main Course'), 'is_special'=>false, 'is_recommended'=>false, 'is_top_selling'=>true]);
        // ID 17: Shahi Paneer
        MenuItem::create(['category_id'=>$mainCourse->id,'name'=>'Shahi Paneer','description'=>'Rich curry','price'=>320, 'image'=>$getImage('Main Course')]);
        // ID 18: Dal Makhani (Recommended)
        MenuItem::create(['category_id'=>$mainCourse->id,'name'=>'Dal Makhani','description'=>'Slow cooked dal','price'=>260, 'image'=>$getImage('Main Course'), 'is_special'=>false, 'is_recommended'=>true, 'is_top_selling'=>false]);
        // ID 19: Butter Chicken (Top Selling)
        MenuItem::create(['category_id'=>$mainCourse->id,'name'=>'Butter Chicken','description'=>'Buttery chicken','price'=>340, 'image'=>$getImage('Main Course'), 'is_special'=>false, 'is_recommended'=>false, 'is_top_selling'=>true]);
        // ID 20: Chicken Curry
        MenuItem::create(['category_id'=>$mainCourse->id,'name'=>'Chicken Curry','description'=>'Spicy chicken','price'=>330, 'image'=>$getImage('Main Course')]);

        /* ---------- Breads ---------- */
        // ID 21: Tandoori Roti (Top Selling)
        MenuItem::create(['category_id'=>$breads->id,'name'=>'Tandoori Roti','description'=>'Wheat roti','price'=>25, 'image'=>$getImage('Breads'), 'is_special'=>false, 'is_recommended'=>false, 'is_top_selling'=>true]);
        // ID 22: Butter Naan (Top Selling + Recommended)
        MenuItem::create(['category_id'=>$breads->id,'name'=>'Butter Naan','description'=>'Butter naan','price'=>40, 'image'=>$getImage('Breads'), 'is_special'=>false, 'is_recommended'=>true, 'is_top_selling'=>true]);
        // ID 23-25: Normal
        MenuItem::create(['category_id'=>$breads->id,'name'=>'Garlic Naan','description'=>'Garlic naan','price'=>50, 'image'=>$getImage('Breads')]);
        MenuItem::create(['category_id'=>$breads->id,'name'=>'Lachha Paratha','description'=>'Layered paratha','price'=>45, 'image'=>$getImage('Breads')]);
        MenuItem::create(['category_id'=>$breads->id,'name'=>'Plain Naan','description'=>'Soft naan','price'=>35, 'image'=>$getImage('Breads')]);

        /* ---------- Rice & Biryani ---------- */
        // ID 26-27: Normal
        MenuItem::create(['category_id'=>$rice->id,'name'=>'Steamed Rice','description'=>'Plain rice','price'=>120, 'image'=>$getImage('Rice & Biryani')]);
        MenuItem::create(['category_id'=>$rice->id,'name'=>'Jeera Rice','description'=>'Cumin rice','price'=>140, 'image'=>$getImage('Rice & Biryani')]);
        // ID 28: Veg Biryani (Special)
        MenuItem::create(['category_id'=>$rice->id,'name'=>'Veg Biryani','description'=>'Veg biryani','price'=>240, 'image'=>$getImage('Rice & Biryani'), 'is_special'=>true, 'is_recommended'=>false, 'is_top_selling'=>false]);
        // ID 29-30: Normal
        MenuItem::create(['category_id'=>$rice->id,'name'=>'Chicken Biryani','description'=>'Chicken biryani','price'=>280, 'image'=>$getImage('Rice & Biryani')]);
        MenuItem::create(['category_id'=>$rice->id,'name'=>'Mutton Biryani','description'=>'Mutton biryani','price'=>360, 'image'=>$getImage('Rice & Biryani')]);

        /* ---------- Drinks ---------- */
        // ID 31-35: Sab Normal (Database ke hisaab se)
        MenuItem::create(['category_id'=>$drinks->id,'name'=>'Sweet Lassi','description'=>'Yogurt drink','price'=>90, 'image'=>$getImage('Drinks')]);
        MenuItem::create(['category_id'=>$drinks->id,'name'=>'Salted Lassi','description'=>'Salty lassi','price'=>90, 'image'=>$getImage('Drinks')]);
        MenuItem::create(['category_id'=>$drinks->id,'name'=>'Cold Drink','description'=>'Soft drink','price'=>60, 'image'=>$getImage('Drinks')]);
        MenuItem::create(['category_id'=>$drinks->id,'name'=>'Lemon Soda','description'=>'Lemon soda','price'=>70, 'image'=>$getImage('Drinks')]);
        MenuItem::create(['category_id'=>$drinks->id,'name'=>'Masala Tea','description'=>'Spiced tea','price'=>40, 'image'=>$getImage('Drinks')]);

        /* ---------- Desserts ---------- */
        // ID 36: Gulab Jamun (Special)
        MenuItem::create(['category_id'=>$desserts->id,'name'=>'Gulab Jamun','description'=>'Sweet balls','price'=>100, 'image'=>$getImage('Desserts'), 'is_special'=>true, 'is_recommended'=>false, 'is_top_selling'=>false]);
        // ID 37: Rasgulla
        MenuItem::create(['category_id'=>$desserts->id,'name'=>'Rasgulla','description'=>'Spongy sweet','price'=>90, 'image'=>$getImage('Desserts')]);
        // ID 38: Jalebi (Recommended)
        MenuItem::create(['category_id'=>$desserts->id,'name'=>'Jalebi','description'=>'Crispy sweet','price'=>80, 'image'=>$getImage('Desserts'), 'is_special'=>false, 'is_recommended'=>true, 'is_top_selling'=>false]);
        // ID 39-40: Normal
        MenuItem::create(['category_id'=>$desserts->id,'name'=>'Gajar Halwa','description'=>'Carrot sweet','price'=>120, 'image'=>$getImage('Desserts')]);
        MenuItem::create(['category_id'=>$desserts->id,'name'=>'Ice Cream','description'=>'Vanilla scoop','price'=>110, 'image'=>$getImage('Desserts')]);
    }
}