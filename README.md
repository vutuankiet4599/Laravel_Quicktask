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
