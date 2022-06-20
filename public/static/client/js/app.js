function confirmDelete(delUrl,message)
{
    if(message) msg = message;
    else msg = 'Bạn có chắc chắn muốn xóa mục đã chọn không?';
    if (confirm(msg)==true)
    {
        document.location = delUrl;
    }
}