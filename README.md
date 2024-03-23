<h1> Table of Contents</h1>
<ul>
<li><a href="#kết-nối-với-cơ-sở-dữ-liệu">Kết nối với cơ sở dữ liệu</a></li>
<li><a href="#tham-số-trong-câu-lệnh-sql">Tham số trong câu lệnh SQL</a></li>
<li><a href="#lấy-kết-quả-từ-cơ-sở-dữ-liệu">Lấy kết quả từ cơ sở dữ liệu</a></li>
</ul>
<h1 id="kết-nối-với-cơ-sở-dữ-liệu">Kết nối với cơ sở dữ liệu</h1>
<p> Để kết nối PHP với cơ sở dữ liệu MySQL, chúng ta sử dụng class <code lang="PHP">PDO</code>. Hàm này có 4 tham số:</p>
<ul>
<li>dsn: chuỗi kết nối đến cơ sở dữ liệu</li>
<li>username: tên đăng nhập</li>
<li>password: mật khẩu</li>
<li>options: mảng chứa các tùy chọn</li>
</ul>
<p> Ví dụ:</p>
<pre><code lang="PHP">
$dsn = 'mysql:host=localhost;dbname=database_name';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$pdo = new PDO($dsn, $username, $password, $options);
</code></pre>
<h4> Trong đó:</h4>
<li> <code lang="PHP">mysql:host=localhost;dbname=database_name</code>: chuỗi kết nối đến cơ sở dữ liệu MySQL. Trong đó, <code lang="PHP">localhost</code> là tên máy chủ, <code lang="PHP">database_name</code> là tên cơ sở dữ liệu.</li> 
<li> <code lang="PHP">root</code>: tên đăng nhập.</li>
<li> <code lang="PHP">''</code>: mật khẩu.</li>
<li> <code lang="PHP">array(PDO::ATTR_ERRMODE =&gt; PDO::ERRMODE_EXCEPTION)</code>: mảng chứa các tùy chọn. Trong đó, <code lang="PHP">PDO::ATTR_ERRMODE</code> là tùy chọn, <code lang="PHP">PDO::ERRMODE_EXCEPTION</code> là giá trị của tùy chọn.</li>
<li>Với 3 tham số =<code lang="PHP">dsn</code>, <code lang="PHP">username</code>, <code lang="PHP">password</code> là <b style="color:red">không bắt buộc.</b></li>
<li>Khi sử dụng XAMPP, <code lang="PHP">username</code> mặc định là <code lang="PHP">root</code>, <code lang="PHP">password</code> mặc định là <code lang="PHP">''</code>.</li>
<> Để kiểm tra kết nối thành công hay không, chúng ta sử dụng câu lệnh <code lang="PHP">try...catch</code>. Nếu kết nối thành công, chúng ta sẽ in ra dòng chữ <code lang="PHP">Connected successfully</code> (Sử dụng hàm <code lang="PHP">echo</code>). Nếu kết nối thất bại, chúng ta sẽ in ra lỗi (Sử dụng hàm <code lang="PHP">getMessage()</code> của biến <code lang="PHP">$e</code>) thuộc lớp <code lang="PHP">PDOException</code>.</p>
<pre><code lang="PHP">
try {
    $pdo = new PDO($dsn, $username, $password, $options);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e-&gt;getMessage();
}
</code></pre>
<p> Kết quả:</p>
<pre><code lang="PHP">
Connected successfully
</code></pre>
<p> Nếu kết nối thất bại, chúng ta có thể sẽ nhận được thông báo lỗi như sau:</p>
<pre><code lang="PHP">
Connection failed: SQLSTATE[HY000] [1045] Access denied for
user 'root
</code></pre>
<p> Trong đó:</p>
<ul>
<li> <code lang="PHP">SQLSTATE[HY000]</code>: mã lỗi.</li>
<li> <code lang="PHP">[1045]</code>: mã lỗi.</li>
<li> <code lang="PHP">Access denied for user 'root</code>: thông báo lỗi.</li>
</ul>

<h1 id="tham-số-trong-câu-lệnh-sql">Tham số trong câu lệnh SQL</h1>
<p> Để tránh lỗi SQL Injection, chúng ta sử dụng tham số trong câu lệnh SQL. Tham số giúp chúng ta truyền dữ liệu vào câu lệnh SQL một cách an toàn. Để sử dụng tham số, chúng ta sử dụng hàm <code lang="PHP">prepare()</code> của class <code lang="PHP">PDO</code>. Hàm này có 2 tham số:</p>    
<ul>
<li>sql: câu lệnh SQL</li>
<li>options: mảng chứa các tùy chọn</li>
</ul>
<p> Ví dụ:</p>
<pre><code lang="PHP">
$sql = 'SELECT * FROM users WHERE id = :id';
$statement = $pdo-&gt;prepare($sql);
</code></pre>
<p> Trong đó:</p>
<li> <code lang="PHP">SELECT * FROM users WHERE id = :id</code>: câu lệnh SQL. Trong đó, <code lang="PHP">:id</code> là tham số.</li>
<li> <code lang="PHP">$pdo-&gt;prepare($sql)</code>: hàm <code lang="PHP">prepare()</code> trả về một đối tượng <code lang="PHP">PDOStatement</code>.</li>
<p> Để truyền giá trị vào tham số, chúng ta sử dụng phương thức <code lang="PHP">bindParam()</code> của đối tượng <code lang="PHP">PDOStatement</code>. Phương thức này có 3 tham số:</p>   
<ul>
<li>parameter: tên tham số</li>
<li>variable: giá trị của tham số</li>
<li>data_type: kiểu dữ liệu của tham số</li>
</ul>
<p> Ví dụ:</p>
<pre><code lang="PHP">
$id = 1;
$statement-&gt;bindParam(':id', $id, PDO::PARAM_INT);

</code></pre>

<p> Trong đó:</p>
<li> <code lang="PHP">1</code>: giá trị của tham số.</li>
<li> <code lang="PHP">PDO::PARAM_INT</code>: kiểu dữ liệu của tham số.</li>
<p> Để thực thi câu lệnh SQL, chúng ta sử dụng phương thức <code lang="PHP">execute()</code> của đối tượng <code lang="PHP">PDOStatement</code>. Phương thức này không có tham số.</p>
<pre><code lang="PHP">
$statement-&gt;execute();
</code></pre>

<h1 id="lấy-kết-quả-từ-cơ-sở-dữ-liệu"> Lấy kết quả từ cơ sở dữ liệu</h1>
<p> Để lấy kết quả từ cơ sở dữ liệu, chúng ta sử dụng phương thức <code lang="PHP">fetch()</code> hoặc <code lang="PHP">fetchAll()</code> của đối tượng <code lang="PHP">PDOStatement</code>. Phương thức <code lang="PHP">fetch()</code> trả về một mảng chứa một bản ghi. Phương thức <code lang="PHP">fetchAll()</code> trả về một mảng chứa tất cả các bản ghi.</p>
<p> Ví dụ:</p>
<pre><code lang="PHP">
$row = $statement-&gt;fetch();
$rows = $statement-&gt;fetchAll();
</code></pre>
<p> Để lấy giá trị từ một bản ghi, chúng ta sử dụng phương thức <code lang="PHP">fetchColumn()</code> của đối tượng <code lang="PHP">PDOStatement</code>. Phương thức này có 1 tham số:</p>
<ul>
<li>column_number: số thứ tự của cột</li>
</ul>
<p> Ví dụ:</p>
<pre><code lang="PHP">
$name = $row['name'];
$age = $row['age'];
$first_name = $row[0];
$last_name = $row[1];
</code></pre>
<p> Trong đó:</p>
<li> <code lang="PHP">$row['name']</code>: giá trị của cột <code lang="PHP">name</code> trong bản ghi.</li>
<li> <code lang="PHP">$row['age']</code>: giá trị của cột <code lang="PHP">age</code> trong bản ghi.</li>
<li> <code lang="PHP">$row[0]</code>: giá trị của cột đầu tiên trong bản ghi.</li>
<li> <code lang="PHP">$row[1]</code>: giá trị của cột thứ hai trong bản ghi.</li>

<hr>
@copyright OMTC - Old Man Teach Code

