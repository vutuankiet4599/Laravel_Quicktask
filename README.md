# Câu hỏi

## Chapter 1

### Câu 1: Có những cách nào để tạo một project Laravel

Môi trường yêu cầu: Ngôn ngữ PHP và Composer - một công cụ quản lý thư viện trong PHP

Em tìm hiểu được 2 cách:

-   Cách 1: Chạy câu lệnh sau của composer:
    ```bash
    composer create-project laravel/laravel <TÊN-PROJECT>
    ```
-   Cách 2: Chạy từng câu lệnh sau
    ```bash
    composer global require laravel/installer
    # Có thể bỏ qua câu lệnh này nếu đã cài đặt Laravel Installer từ trước
    laravel new <TÊN-PROJECT>
    ```

### Câu 2: Nêu mục đích chính, ngắn gọn của các thư mục trong dự án

Phần này em sẽ chỉ nói về những phần hay dùng

-   File .env: Chứa các biến môi trường (như là tên database, port...).
-   Folder /app: Là nơi chứa những logic mà mình viết.
    -   Folder /app/Exceptions: Là nơi để mình chứa code của phần xử lý dữ exception.
    -   Folder /app/Http: Là nơi để chứa những logic của mình.
        -   Folder /app/Http/Controllers: Chứa các controller mà mình đã khai báo.
        -   Folder /app/Http/Middlewares: Chứa các middleware mà mình đã khai báo.
    -   Folder /app/Models: Chứa các model để thực hiện thao tác với database.
-   Folder /config: Chứa những file config của project.
-   Folder /bootstrap: Nơi khởi tạo ứng dụng, các Kernel, ...
-   Folder /database: Chứa những file liên quan tới thiết lập các bảng trong database.
    -   Folder /database/migrations: Chứa các file migration để tạo, chỉnh sửa các bảng trong database.
    -   Folder /database/seeders: Chứa các file tạo mock dữ liệu cho database.
    -   Folder /database/factories: Chứa các file giúp tạo mock data một cách tự động.
-   Folder /resources: Chứa các file trong phần view (file blade, html, css, js).
-   Folder /routes: Chứa các file routing. Có 2 file quan trọng nhất trong đây:
    -   /routes/web.php: điều hướng đến các file views.
    -   /routes/api.php: điều hướng tới các api.
-   Folder /storage: Chứa những file lưu trong local (file cache, session, log).
-   Folder /tests: Chứa những file tests mà mình viết ra.
-   File /composer.json: File chứa các tên package php đang được sử dụng trong project.
-   File /package.json: File chứa tên các package javascript đang được sử dụng trong project
-   Folder /vendor: Chứa các package php đang được sử dụng cài đặt thông qua composer.

### Câu 3: Vòng đời của một request trong Laravel

-   Các request sẽ đi vào file /public/index.php. File này sẽ load các autoload do composer định nghĩa ra rồi chạy /bootstrap/app.php.
-   Tiếp đó. request sẽ đi vào HTTP Kernel hoặc là Console Kernel tùy vào loại request. (/app/Http/Kernel.php và /app/Console/Kernel.php)
-   HTTP Kernel extends Illuminate\Foundation\Http\Kernel chứa các bootstrappers tiền xử lý trước khi request được xử lý. Nó cũng định nghĩa các HTTP Middleware buộc các request phải đi qua trước khi đến xử lý chính bởi ứng dụng.
-   Tiếp đó, phương thức handle của kernel sẽ tham số là Request rồi xử lý và trả ra Response
-   Khi router hay controller trả ra response, nó sẽ đi qua các route middleware cho phép ứng dụng chỉnh sửa và kiểm tra các response. Sau đó phương thức handle của HTTP Kernel trả ra một object và file index.php gọi phương thức send để trả ra kết quả cho người dùng

## Chapter 2

### Câu 1: Migration là gì

Migration làm việc giống như là một cái version control giúp chúng ta xác định và chia sẻ định nghĩa của lược đồ cơ sở dữ liệu của ứng dụng

### Câu 2: Hàm up() và down() trong một class migration để làm gì

-   Hàm up() dùng để tạo mới, xóa, sửa bảng, cột, hoặc là index vào database.
-   Hàm down() là để đảo ngược lại các hành động của hàm up().

### Câu 3: Nêu các câu lệnh thông dụng của migration mà bạn biết

Một số câu lệnh thông dụng:

-   Tạo một migration: php artisan make: migration <TÊN-MIGRATION>
-   Chạy migration: php artisan migrate
-   Rollback toàn bộ migrate và chạy lại migrate: php artisan migrate:refresh
-   Rollback về một migration nào đó: php artisan migrate:rollback

### Câu 4: Mass assignment là gì

Là một quá trình gửi một mảng dữ liệu mà sẽ được lưu vào model được chỉ định cùng một lúc. Mình sẽ không phải lưu từng dữ liệu trên model mà nó sẽ theo một quy trình duy nhất

### Câu 5: Cách xử lý Mass assignment trong Laravel

-   Cách phương thức để tạo mass assignment

```php
ModelName::create(ArrayData);
// hoặc
$model = new ModelName();
$model->fill(ArrayData);
```

-   Một số thuộc tính

```php
$fillable = [];
// Định nghĩa các trường sẽ được phép mass assignment
$guarded = [];
// Định nghĩa các trường không được phép mass assignment
```

### Câu 6: Tại sao Laravel có thuộc tính "fillable" và "guarded"

Bởi vì mass assignment tiềm ẩn một lỗ hổng bảo mật. Các dữ liệu được gửi lên từ client có thể chứa những thông tin mà ta không mong muốn. Ví dụ như trong bài học model User có trường is_admin mà ta không muốn người dùng được quyền sửa nhưng khi gửi form người dùng có thể sửa đổi code html để gửi thông tin is_admin = true lên và mass assignment sẽ tự dộng lưu thông tin đó. Vì thế chúng ta cần 2 trường này. Mục đích của 2 trường này xem câu 5.

### Câu 7: Với các thuộc tính nằm trong blacklist ta làm thế nào để cập nhật các trường dữ liệu đó

Dùng phương thức bình thường để cập nhật nó. Ví dụ:

```php
$user = User::find(1); // Tìm kiếm user với id là 1
$user->is_admin = true; // Cập nhật thông tin user
$user->save(); // Lưu lại thông tin đã cập nhật
```

## Chapter 3

### Câu 1: Kể tên các quan hệ của Laravel và các phương thức tương ứng

-   One To One: hasOne() và belongsTo().
-   One To Many: hasMany() và belongsTo().
-   Many To Many: withPivot() và belongsToMany().
-   Has One Through: hasOneThrough().
-   Has Many Through: hasManyThrough().
-   One To One (Polymorphic): morphTo() và morphOne().
-   One To Many (Polymorphic): morphTo() và morphMany().
-   Many To Many (Polymorphic): morphToMany() và morphedByMany().

### Câu 2: Các hàm attach(), detach(), toggle(), sync() dùng để làm gì ?

-   Những phương thức này làm việc trong quan hệ Many To Many.
-   attach(): Chèn thông tin vào bản ghi trung gian giữa 2 bảng.
-   detach(): Xóa thông tin trong bản ghi trung gian giữa 2 bảng. Tuy nhiên thông tin của 2 bảng vẫn còn lưu lại.
-   sync(): Nhận một mảng id để đặt lên bảng trung gian. Bất kỳ id nào không có trong mảng đã cho sẽ bị xóa khỏi bảng trung gian.
-   toggle(): Lật detach thành attach hay ngược lại.

### Câu 3: Làm thế nào để lấy dữ liệu từ bảng trung gian trong quan hệ n-n

-   Có thể dùng phương thức withPivot(). Ví dụ trong quan hệ User và Role:

```php
class User extends Authenticatable {
    public function roles() {
        return $this->belongsToMany(Role::class, 'roles_users')->withPivot('created_at');
    }
}
$roles = User::first()->roles;
foreach ($roles as $role) {
    echo $role->pivot->created_at;
}
```

## Chapter 4

### Câu 1: Accessors/Mutators dùng để làm gì ?

-   Accessors: là các phương thức dùng để chuyển đổi giá trị của thuộc tính khi nó được truy cập.
-   Mutators: Là các phương thức dùng để chuyển đổi giá trị của thuộc tính trước khi được lưu vào database khi nó được set.

### Câu 2: Tạo Accessors/Mutators như thế nào ?

Tạo ở bên trong Model. Ở đây ví dụ sử dụng model User.

-   Accessors:

```php
// Chuyển toàn bộ ký tự thành chữ hoa trước khi lấy ra
public function firstName(): Attribute {
    return Attribute::make(
        get: fn (string $value) => Str::upper($value),
    );
}
User::first()->first_name;
// Output: vu van => VU VAN
```

-   Mutators:

```php
// Chuyển username thành dạng slug trước khi lưu
public function username(): Attribute {
    return Attribute::make(
        set: fn (string $value) => Str::slug($value),
    );
}
$user = User::create(['first_name'=>'vu tuan', 'last_name'=>'kiet','email'=>'vutuankiet@gmail.com','username'=>'vu tuan kiet','password'=>md5('123456'),'is_active'=>true]);
$user->username // 'vu-tuan-kiet'
```

### Câu 3: Scope dùng để làm gì ?

Scope hay Query Scope là một cách đóng gói và tái sử dụng câu truy vấn trong Eloquent ORM. Nó cho phép xác định các phương thức để mở rộng và tùy chỉnh câu truy vấn. Bằng cách áp dụng scope mình có thể tạo các phương thức tùy chỉnh để áp dụng điều kiện, sắp xếp, phân trang hoặc thực hiện các thao tác khác trên câu truy vấn.

### Câu 4: Nêu các loại scope trong Laravel

Có 2 loại scope là Global Scope và Local Scope.

-   Global Scope: Câu truy vấn được định nghĩa trong scope sẽ có tác dụng trong mọi truy vấn của model.
    -   Tạo một global scope với tên là ActiveUser
    ```bash
    php artisan make:scope ActiveUser
    ```
    -   Định nghĩa câu truy vấn trong scope:
    ```php
    class ActiveUser implements Scope
    {
        // Return là void
        public function apply(Builder $builder, Model $model): void
        {
            $builder->where('is_active', '=', true);
        }
    }
    ```
    -   Áp dụng nó vào trong model. Tại model User:
    ```php
    protected static function booted(): void {
        static::addGlobalScope(new ActiveUser);
    }
    ```
    -   Sử dụng
    ```php
    User::all();
    // Sẽ trả ra các user mà có is_active là true
    ```
-   Local Scope: Câu truy vấn được định nghĩa có thể dễ dàng tái sử dụng dễ dàng khi được gọi.
    -   Tạo local scope trong User model:
    ```php
    // Tên tiền tố là scope, return là void
    // Lấy toàn bộ user có is_admin là true
    public function scopeIsAdmin(Builder $query): void {
        $query->where('is_admin', true);
    }
    ```
    -   Sử dụng:
    ```php
    User::isAdmin()->get();
    // Trả ra toàn bộ user có is_admin là true
    ```

## Chapter 5

### Câu 1: Seeder/Factory/Faker dùng để làm gì?

-   Seeder: Giúp chúng ta chèn dữ liệu ban đầu như tài khoản Admin... vào trong database mà không cần thông qua thao tác của người dùng (Chạy phía server).
-   Factory: Giúp chúng ta tạo số lượng lớn các bản ghi để chèn vào database. Thường dùng đi kèm với Seeder.
-   Faker: Dùng để tạo dữ liệu giả để làm dữ liệu test. Có thể tạo dữ liệu ở nhiều định dạng như text, email, address, file, username... Thường dùng với Factory và Seeder.

### Câu 2: Khi nào nên sử dụng Seeder? Khi nào nên sử dụng Factory?

-   Seeder:

    -   Dùng khi muốn tạo dữ liệu mẫu ban đầu với cơ sở dữ liệu.
    -   Thường dùng để tạo dữ liệu cố định, không đổi thường xuyên.
    -   Thường dùng trong quá trình triển khai ban đầu của hệ thống hoặc trong giai đoạn phát triển.

-   Factory:
    -   Dùng khi cần tạo dữ liệu mẫu động hoặc tạo nhanh nhiều bản ghi trong quá trình phát triển và kiểm thử
    -   Dùng để tạo dữ liệu giả lập cho các model.
    -   Dùng trong quá trình phát triển và kiểm thử.
    -   Dùng để tùy chỉnh dữ liệu mẫu trong quá trình phát triển

## Chapter 6:

### Câu 1: Mô tả cấu trúc một route trong Laravel

Cấu trúc một route cơ bản trong laravel

```php
Route::middleware($middleware)->method($uri, $callback)->name($name);
```

-   Đầu tiên là Route Facade để thông báo là mình đang khởi tạo một route.
-   Sau đó là middleware [OPTIONAL]: là một string hoặc array hoặc null dùng để khai báo các middleware request phải đi qua trước khi được xử lý.
-   Sau đó là method: Là các phương thức HTTP: GET (get), POST (post), PUT (put), DELETE (delete), PATCH (patch)... để xác định các yêu cầu được xử lý
-   Trong method có 2 tham số:
    -   $uri: là một string dùng để nhận biết được request từ địa chỉ nào.
    -   $callback: là một array hoặc string hoặc callable hoặc null dùng để khai báo phương thức xử lý request trong route.
-   Cuối cùng là name [OPTIONAL]: dùng để đặt tên cho route. đầu vào là string

Ngoài ra, Route Facade còn hỗ trợ gom nhóm route thông qua phương thức group() và cho phép đặt tiền tố của một nhóm route bằng phương thức prefix().

### Câu 2: Kể tên các hàm trong resource controller và phương thức/công dụng tương ứng.

-   Các phương thức trong resource controller:
    -   index(): Hiển thị danh sách các resource.
    -   create(): Hiển thị form tạo resource mới.
    -   store(): Lưu resource vừa tạo.
    -   show(): Hiển thị một resource được chỉ định.
    -   edit(): Hiển thị form để sửa một resource được chỉ định.
    -   update(): Cập nhật thông tin của một resource được chỉ định.
    -   delete(): Xóa resource được chỉ định

### Chapter 7

## Câu 1: Middleware dùng để làm gì?

-   Nó là một tầng nằm giữa server và clients. Khi người dùng gửi request, nó sẽ đi qua các middleware của Laravel và tới bên trong controller. Khi controller xử lý xong dữ liệu và gửi trả lại người dùng nó cũng sẽ đi qua một số middleware.
-   Khi các request đi qua các middleware, middleware sẽ có nhiệm vụ tiền xử lý, chỉnh sửa, kiểm tra xem các request trước khi đi vào xử lý chính. Một số công việc thường gặp trong middleware: Xác thực; Kiểm tra vai trò; Kiểm tra quyền; Xử lý CSRF; Xử lý dữ liệu đầu vào; Ghi log

## Câu 2: Phân biệt Global Middleware, Group Middleware và Route Middleware

-   Global Middleware: Bất cứ request nào đi vào server cần phải đi qua middleware này này.
-   Group Middleware: Các middleware được gộp thành nhóm để gọi. Ví dụ như trong file App\Http\Kernel.php có 2 group sẵn là web middleware, api middleware.
-   Route Middleware: Áp dụng cho từng route cụ thể. Chỉ được gọi khi request đi đến route được setup.

## Chapter 8:

### Câu 1: Bạn biết những starter kit Authentication nào của Laravel ?

-   Một số starter kit authentication trong Laravel là: Laravel Breeze, Laravel Jetstream, etc

### Câu 2: Trong Quicktask bạn dùng starter nào. Khi cần customize logic thì cần sửa ở đâu ?

-   Trong Quicktask em đã sử dụng Laravel Breeze. Khi cần customize logic:
    -   Đối với logic của controller: Tại thư mục `app\Http\Controllers\Auth` hoặc file `app\Http\Controllers\ProfileController.php` ta có thể chỉnh sửa logic của controller tương ứng với tác vụ yêu cầu
    -   Đối với logic của view: Các file trong folder `resources\views\auth` là các file view mà ta có thể chỉnh sửa như thêm thông báo, thêm trường trong biểu mẫu... để phục vụ tác vụ của mình
    -   Đối với validation rules: Trong thư mục ``app\Http\Requests\Auth` chứa các file có validation rule. Muốn chỉnh sửa rule ta có thể chỉnh sửa các file trong đây.

## Chapter 10

### Câu 1: Package manager như npm, bower dùng để làm gì ?

-   Các package manager như là npm, yarn, bowe dùng để quản lý, tải cài đặt, quản lý phiên bản và tài liệu các dependencies của javascript. Ngoài ra nó cũng cung cấp các lệnh và tác vụ để kiểm tra phiên bản, cập nhật dependencies...

### Câu 2: Tại sao chúng ta nên thực hiện compile các file css/sass/js... thay vì viết trực tiếp vào public? Bạn sử dụng công cụ nào của Laravel để quản lý và compile các file đó?

Chúng ta cần thực hiện compile các file css/sass/js... thay vì viết trực tiếp vào public với những lý do sau:

-   **_Tăng hiệu năng_**: Các file sau khi được compile ra thường sẽ nhẹ hơn các file gốc, giảm thời gian tải trang giúp tăng hiệu năng.

-   **_Giúp tương thích với nhiều trình duyệt_**: Các trình duyệt khác nhau có hỗ trợ khác nhau với từng ngôn ngữ và từng phiên bản. Việc compile này giúp chương trình có thể chạy trên nhiều trình duyệt mà chỉ cần viết một lần.

-   **_Giúp chuyển đổi code_**: Trình compile có thể compile có thể chuyển đổi code của các phiên bản cấp cao hơn (ví dụ ES6 Javascript) thành mã mà các trình duyệt phiên bản cũ có thể hiểu được. Hơn nữa một số file như typescript, sass không phải là file trình duyệt có thể hiểu được nên cần compile thành file mà trình duyệt có thể hiểu.

-   **_Giúp tổ chức code_**: Khi code ta thường chia thành nhiều file, thành các module nhỏ để dễ phát triển, bảo trì. Trình compile sẽ compile thành 1 file duy nhất để triển khai.

## Chapter 12

### Câu 1: Cách hoạt động của Eloquent ORM và Query Builder

-   **_Eloquent ORM:_** là 1 tính năng giúp map các bảng trong database với các Model. Eloquent ORM cho phép chúng ta việc thao tác với cơ sở dữ liệu trở nên dễ dàng hơn nhiều. Eloquent ORM cung cấp nhiều phương thức truy cập dữ liệu dễ dàng cho cả với những người chưa có cơ sở nhiều về SQL.

-   **_Query Builder_**: Trong Laravel, Query Builder cung cấp cơ chế dễ dàng để chạy các database query. Nó có thể được sử dụng để thực hiện tất cả, từ kết nối database cơ bản, CRUD, aggregates.... Query Builder sử dụng PDO nên có thể phòng một số tấn công như là SQL Injection. Để dùng Query Builder thì cần biết SQL cơ bản trước. Dùng thông qua Facade DB.

-   Ví dụ lấy toàn bộ bản ghi trong bảng `users` tương ứng với model `User`:
    ```php
    // Với Eloquent ORM
    User::all();
    // Với Query Builder
    DB::table('users')->get();
    ```

### Câu 2: Nêu ưu/nhược điểm của chúng

**Eloquent ORM:**

-   **_Ưu điểm:_**
    -   Bảo mật cao hơn Query Builder do có một Abstraction Layer giữa project và database. Ta không phải trực tiếp viết câu lệnh SQL giảm thiểu khả năng tấn công SQL Injection. Nó còn hỗ trợ Parameter Binding, Validation và Mass Assignment để đảm bảo an toàn cho câu truy vấn.
    -   Dễ dùng hơn do cú pháp ngắn gọn, dễ hiểu, không cần quá nhiều kiến thức SQL.
    -   Quản lý relationship dễ dàng giữa các model, các bảng thông qua nhiều phương thức như `hasMany()`, `belongsTo()`...
-   **_Nhược điểm:_**
    -   Hiệu suất truy cập chậm hơn do có một Abstraction Layer.
    -   Khó thực hiện câu truy vấn phức tạp.
    -   Cần thời gian để học hỏi, tìm hiểu về cách hoạt động của nó

**Query Builder:**

-   **_Ưu điểm:_**
    -   Hiệu suất nhanh hơn do Eloquent.
    -   Có thể xử lý những câu truy vấn phức tạp.
-   **_Nhược điểm:_**
    -   Có khả năng xảy ra SQL Injection nếu không sử dụng đúng cách.
    -   Mã nguồn phức tạp hơn, khó đọc hơn.
    -   Cần có kiến thức SQL nền tảng.

### Câu 3: Khi nào nên dùng QB hoặc EO?

-   **_Query Builder:_** Khi cần làm việc với một lượng dữ liệu lớn, cần thực hiện các truy vấn phức tạp hay các thao tác liên quan đến cơ sở dữ liệu mà có yêu cầu về hiệu năng hay là trong trường hợp Eloquent không thể xử lý được câu truy vấn.
-   **_Eloquent ORM:_** Khi bản ghi không quá nhiều hay không có yêu cầu về hiệu năng, cần tính bảo mật hay là khi cần làm việc với nhiều relationship giữa các bảng. Ngoài ra còn sử dụng nếu cần một số chức năng của nó như soft deletes...

### Câu 4: Phân biệt Lazy loading và Eager loading

-   **_Lazy loading:_** Dữ liệu relation của một model chỉ được lấy khi ta truy cập vào nó. Ví dụ:

```php
$users = User::all();
foreach ($users as $user)
{
    foreach ($user->tasks as $task)
    {
        echo $task->content;
    }
}
```

-   **_Eager loading:_** Dữ liệu relation của một model sẽ được lấy ra cùng với model khi model được truy cập. Điều này làm giảm số lượng câu truy vấn và thời gian truy cập tới database. Ví dụ:

```php
$users = User::with('tasks')->get();
foreach ($users as $user)
{
    foreach ($user['tasks'] as $task)
    {
        echo $task['content'];
    }
}
```

### Câu 5: Phân biệt with() và load()

Ví dụ:

```php
User::with('tasks')->get();
User::all()->load('tasks');
```

Cả 2 đều thực hiện câu truy vấn sau:

```sql
select * from users;
select * from tasks where user_id in (1, 2, 3, 4, 5, ...);
```

Điểm khác nhau giữa with và load ở đây là thứ tự thực hiện.

-   `with()` sẽ làm việc với query builder trước, rồi khi gặp những phương thức như `get()` hay `first()`... nó sẽ trả kết quả là các collection.
-   `load()` thì nó làm việc với các collection, chương trình sẽ chạy các phương thức như `all()`, `first()` trước đưa ra các collection và sau đó thực hiện `load()` các relations sau này.
