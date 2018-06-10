# Poro\Image_Checker

Poro image format detector

## Usage

- Khởi tạo đối tượng với đầu vào là  path local đến file hoặc 1 đường link web, cũng có thể là source/resource.


```
$image = new \Poro\Image_Checker\ImageChecker($path, $src = null);
```

- Phát hiện format của file ảnh

```
$image->detectFormat();

```
 
- Kiểm tra file ảnh có thuộc định dạng mong muốn không

```
$image->isGIF();
$image->isBMP();

``` 

- Tùy chỉnh biến `IMAGE_STORAGE` trong file `.env` để lựa chọn đường dẫn lưu ảnh để tải về khi đầu vào là đường dẫn online của ảnh.

## Note
Mới chỉ hỗ trợ detect 1 số định dạng phổ biến như JPG, PNG, BMP, TIFF, GIF. 

Muốn detect thêm các định dạng khác, tham khảo [File Signature](https://www.garykessler.net/library/file_sigs.html?utm_source=tool.lu)