<?php

namespace Tests\Unit;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Tests\TestCase;


class ExampleTest extends TestCase
{
    use HasRoles;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_true_is_true()
    {

        $user = User::first();
        $role = Role::updateOrCreate(['name' => 'writer', 'guard_name' => 'web']);

        $permission = Permission::updateOrCreate(['name' => 'edite article', 'guard_name' => 'web']);
        $role->givePermissionTo($permission);//یک پرمیشن را به یک رول ربط می دهیم
        //$permissions=Permission::pluck('id');

        $user->givePermissionTo('edite article');
        $user->assignRole($role);
        //$role->syncPermissions($permissions);
        //dd($role->load('permissions')->toArray());
        dd($user->load('roles', 'permissions')->toArray());


        $this->assertTrue(true);
    }


    public function test_add_role()
    {
        Role::create([
            'name' => 'user'
        ]);

//        Product::create([
//            "user_id"=>,
//            'name'=>,
//            'price'=>,
//            'created_at'=>,
//
//        ]);
        $this->assertTrue(true);

    }

    public function test_add_permission()
    {
        foreach (range(1, 6) as $item) {
            Permission::create([
                'name' => 'permission_test' . rand(100, 200)
            ]);
        }


        $this->assertTrue(true);

    }

    public function test_create_role_permission_relation()
    {
        $role = Role::find(3);
        $permissions = Permission::whereIn('id', [1, 2, 3])->get();
        foreach ($permissions as $permission) {
            DB::table('role_permission')->insert([
                'role_id' => $role->id,
                'permission_id' => $permission->id,
            ]);
        }


        $this->assertTrue(true);

    }

    public function test_create_user_role_relation()
    {
//        $role=Role::find(3);
//        $role->users()->sync([1,2]);
//        $data=DB::table('role_users')->insert([
//            'user_id'=>1,
//            'role_id'=>$role->id
//        ]);
        $this->assertTrue(true);

    }

    public function test_create_exam()
    {
        $a = 5;
        $b = 8;
        $c = 10;

        $sum = $a + $b + $c;
        $ave = $sum / 3;
        dd($ave);


    }

    public function test_create_exam2()
    {
        $a = 6;

        if ($a % 2 == 0) {
            echo 'عدد زوج است';
        } else {
            echo 'عدد فرد است';
        }
    }

    public function test_create_exam3()
    {
        $data = 8;
//        $a = ['a', 'b', 'c', 'd', 'e', 'f'];
//        $b = ['A', 'B', 'C', 'D', 'E', 'F'];
//        $c = ['1', '2', '3', '4'];
//        if (in_array($data, $a)) {
//            echo 'حروف بزرگ است';
//        } elseif (in_array($data, $b)) {
//            echo 'حروف کوچک است';
//        } elseif (in_array($data, $c)) {
//            echo 'عدد است';
//        }
        $pattern = "/[A_Z]/";
        $pattern1 = "/[a_z]/";
        $patternNumber = "/[1_9]/";
        $big = preg_match($pattern, $data);

        $small = preg_match($pattern1, $data);
        $number = preg_match($patternNumber, $data);

        if ($big) {
            echo 'حروف بزرگ است';

        } elseif ($small) {
            echo 'حروف کوچک است';

        } elseif ($number) {
            echo 'عدد است';

        }


    }

    public function test_create_exam4()
    {

        for ($i = 1000; $i <= 10000; $i++) {
            if ($i % 7 == 0 and $i % 3 != 0) {
                echo $i;
                echo '   ';
            }
        }
    }

    public function test_create_exam5()
    {
        $a = 12;
        for ($i = 1; $i <= $a; $i++) {
            if ($a % $i == 0) {
                echo $i;
                echo '  ';
            }
        }
    }

    public function test_create_exam6()
    {
        $array = [1, 2, 0, 0, 6, 8, 9, -5, -6, -7, -9];
        $mothbats = [];
        $manfi = [];
        foreach ($array as $arr) {
            if ($arr >= 0) {
                $mothbats[] = $arr;
                //array_push($mothbats, $arr);

            } else {
                $manfi[] = $arr;
            }
        }

        $lengthMothbat = count($mothbats);
        $lengthManfi = count($manfi);
        $sum = 0;
        foreach ($mothbats as $mothbat) {
            $sum += $mothbat;
        }
        foreach ($manfi as $m) {
            $sum1 += $m;
        }
        $arrayMothbat1 = $sum / $lengthMothbat;
        echo $arrayMothbat1;
        echo '   ';
        $arrayManfi1 = $sum1 / $lengthManfi;
        echo $arrayManfi1;

    }

    public function test_create_exam7()
    {

//محیط و مساحت مستظیل
        $a = 10;
        $b = 20;
        $area = $a * $b;
        echo $area;
        echo '  ';
        $Environment = ($a + $b) * 2;

        echo $Environment;
    }

    public function test_create_exam15()
    {
        $r = 2;
        $area = 3.14 * $r * $r;
        $enventory = 2 * 3.14 * $r;
        echo $area . '  ' . $enventory;
//        echo '  ';
//        echo $enventory;

    }

    public function test_create_exam16()
    {
        $x = 12;
        $y = 14;
        //$x=$x+$y;
        $x += $y;
        $y = $x - $y;
        echo 'y = ' . $y;
        echo '  ';
        // $x=$x-$y;
        $x -= $y;
        echo 'x = ' . $x;

    }

    public function test_create_exam17()
    {

        $A = ord("S");
        echo($A);
    }

    public function test_create_exam18()
    {
        $name = 'zakeri';
        $media = 'youtube';
        echo 'hello  ' . $name . '  wellcom to  ' . $media;
    }

//مسعله ی فصل یک سوال 8
    public function test_create_examT8()
    {
        $x = 75000;
        $increas = $x * 1350;
        $salaryOfmember = $increas;
        $salaryOfYears = $salaryOfmember * 12;
        $AdditionalAnnualFee = ($salaryOfYears * 2) - $x * 2;
        echo 'Additional annual fee is  ' . $AdditionalAnnualFee;


    }

    public function test_create_examT9()
    {
        $priceOFpen = 50000;
        $oriceOFpaper = 4000000;

        $numberOFpen = 150 * $priceOFpen;
        $numberOfpaper = 50 * $oriceOFpaper;

    }

    public function test_create_exam3_2()
    {
//         for($i=0;$i<=3.5;$i+=0.5){
//             echo $i.'  ';
//         }
//         for($ch='a';$ch<='f';$ch++){
//             echo $ch.ord($ch).'  ';
//         }
        $x = 'Hello  To All Of World . sfsf';
        //print_r(str_word_count($x, 2));
        echo str_word_count($x);

    }

    public function test_create_exam3_7()
    {
        $count = 0;

        for ($i2 = 0; $i2 <= 50; $i2++) {
            for ($i5 = 0; $i5 <= 20; $i5++) {
                for ($i10 = 0; $i10 <= 10; $i10++) {
                    for ($i50 = 0; $i50 <= 2; $i50++) {
                        $sum = $i2 * 2 + $i5 * 5 + $i10 * 10 + $i50 * 50;
                        if ($sum == 100) {
                            echo('2rial=' . $i2 . '  50Rials=' . $i50 . ' 10Rial=' . $i10);
                            echo ".\n";
                            $count++;
                        } else {
                            $sum = 0;
                        }
                    }
                }
            }
            //echo $sum;
        }
        print_r($count);

    }

    public function test_create_exam3_8()
    {
        $NUM = 4;
        for ($sum = 0, $count = 1, $x = 1; $count <= $NUM; $count++, $x *= 2) {
            $sum += 1 / $x;
            echo $sum . '  ';
        }
    }

    public function test_create_exam3_10()
    {
        $array = [2, 1, 4, 3];//30
        $sum = 0;
        foreach ($array as $arr) {
            $m = $arr * $arr;

            $sum += $m;

        }

        echo $sum;
//        echo "\n";
//        echo strlen("PHP Tutorial Series");
//        echo "\n";
//        echo str_word_count("Hello dear SabzDanesh users!");

    }

    public function test_create_exam3_12()
    {
//        $b=5;
//        $x=rand();
//        echo $x.'  ';
//        if($x==$b){
//            echo 'شما برنده شدید';
//        }elseif ($b>$x){
//            echo 'عدد بزرگتر است';
//        }else{
//            'عدد کوچکتر است';
//        }


//        printf("Enter Width: \n");
//        fscanf(STDIN,"%d",$a);
//        print("Enter Height: \n");
//        fscanf(STDIN,"%d",$b);
//        $area = $a*$b;
//        fprintf(STDOUT,"Area is: %d",$area);


//        $num=10;
//        $n=0;$count=0;
//        while(1){
//            if($num==0){
//                break;
//                $n++;
//                if($num%2==0){
//                    $count++;
//                }
//
//            }
//        }
//        echo $count.'  '.$n-$count;
    }

    public function test_create_exam3_13()
    {
        $count = 0;
        $array = [10, 5, 3, 8, 6, 14, 18, 9, 9, 0, 3, 20, 7];

        foreach ($array as $arr) {
            $arrayL[] = $arr;

            if ($arr % 2 == 0) {

                if ($arr == 0) {
                    $arrayLenght = count($arrayL);

                    break;
                }
                $count++;

            }

        }
        echo 'number of odd=' . $count . '   AND  number of even=' . abs($arrayLenght - $count - 1);

    }

    public function test_create_exam3_1A()
    {
        $students = [1 => 14, 2 => 15, 3 => 16, 4 => 12, 5 => 20, 6 => 19, 7 => 11, 8 => 8];
        //$students=['1'=>'14','4'=>'16','6'=>'20','2'=>'12'];
        asort($students, 1);
        $aa = count($students);

        echo $students[$aa - 2] . ".\n";
        foreach ($students as $number => $grade) {
            echo 'number of student=' . $number . '   grade of student=' . $grade . ".\n";

        }
    }

    public function test_create_exam4_1()
    {

        $hours = 14;
        $minutes = 24;
        $second = 32;
        $time = (60 * $hours + $minutes) * 60 + $second;
        echo $time;
    }

    public function test_create_exam5_12()
    {
        $word = "welcom";
        echo strtoupper($word);
    }

    public function test_create_exam5_13()
    {
        $str = "I have been used php5 for 3 years. But now i use php7 instead of.";
        $pattern = "/php[3-8]/";
        echo $result = preg_replace($pattern, "python", $str);
    }

    public function test_create_exam5_14()
    {
        $str = "Banana";
        echo str_replace('Banana', 'Apple', $str);
    }

    public function test_create_exam5_9()
    {
        $mat = [
            [5, 9],
            [8, 3],
            [99, 6],
        ];

        $r = 3;
        $c = 2;
        for ($i = 0; $i < $r; $i++) {
            $rmax = 0;
            for ($j = 0; $j < 2; $j++) {

                if ($mat[$i][$j] > $rmax) {

                    $rmax = $mat[$i][$j];

                }


            }
            $maximum[] = $rmax;


        }


        foreach ($maximum as $key => $bigNumber) {
            echo "سطر" . $key . '   بزرگترین عنصرش برابراست با' . $bigNumber;
            echo "\n";
        }
    }


    public function test_create_exam5_11()
    {
        echo(min(array(44, 16, 81, 12)));

    }

    public function test_create_exam33333333()
    {
        $targetNumber = rand(1, 100);
        $attempts = 0;
        $won = false;

    }

    public function test_create_exam5_15()
    {
        $s = "computer science";
        $ch = "e";
        $n = 2;
        $count = 0;
        $len = strlen($s);

        for ($i = 0; $i < $len; $i++) {
            if ($s[$i] == $ch) {
                $count++;

                if ($count == $n) {
                    echo $i + 1;

                }
            }
        }

    }



















    public function exam3($result2)
    {
        $count = 0;
        $e = 0;
        foreach ($result2 as $numberArray) {
            if ($numberArray % 2 == 0) {
                $even[] = $numberArray;
                $count++;
            } else {
                $odd[] = $numberArray;

                $e++;
            }
        }
        return array($count,$e, $even, $odd);

     }
    public function exam2($result)
    {

         return array_reverse($result);
    }
    public function test_create_examm1()
    {
        for ($i = 1; $i <= 100; $i++) {
            $number[] = $i;
        }
        $min = 20;
        $max = 65;

        $result = $this->get_new($max,$min,$number);

        ///  /////////////////////////سوال 2
        ///
        $result2=$this->exam2($result);
        foreach ($result2 as $r){
            //echo $r;
        }


        //سوال سوم/////////سوال سوم////////سوال سوم///////


          $result3=$this->exam3($result2);

         //echo "count of odd:".$result3[0];
       // echo "\n";
          //echo "count of even".$result3[1];
        //سوال چهارم/////////////////////سوال چهارم////
          echo(max($result3[2]));

        echo "even"."\n";
        echo(min($result3[2]));
        echo "\n";
        //  echo(max($result3[3]));
        echo "odd:"."\n";
        //  echo(min($result3[3]));
        echo "\n";


    }

    public function numberB2($max, $min, $numberB)
    {
        for ($j = $min; $j <= $max; $j++) {
            $numberB[] = $j;
        }
    }

    public function test_create_examm4()
    {
        $str = "I have been used php5 for 3 years. But now i use php7 instead of";
        echo strlen($str);
    }

    public function test_create_examm55()
    {
        for ($i = 0; $i <= 100; $i++) {
            $ch[] = md5(time());

        }
        foreach ($ch as $c) {
            echo $c;
            echo "\n";
        }

    }


    public function get_new($max, $min, $number)
    {
        foreach ($number as $item) {
            if ($item > $min && $item < $max) {

                $n[] = $item;
            }

        }

        return $n;
    }


}
