<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="vi" xml:lang="vi">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title> Kết quả trả về thành công </title>
</head>
<body>	
<h3>LƯU Ý: SAU KHI NHẬN KẾT QUẢ THÀNH CÔNG, MERCHANT CẦN GỌI API GetTransactionDetail CỦA NGÂN LƯỢNG ĐỂ KIỂM TRA LẠI CHÍNH XÁC CÁC THÔNG TIN: MÃ ĐƠN HÀNG, SỐ TIỀN ĐƠN HÀNG,...</h3>


@if ($status_code->error_code == '00')
	<h1>Thanh toan thanh cong</h1>
@else
	{{$status_code}}
@endif

</body>	
</html>		