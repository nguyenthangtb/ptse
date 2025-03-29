#!/bin/bash

# Định nghĩa màu sắc cho output
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Đường dẫn đến thư mục dự án Laravel (thay đổi theo đường dẫn thực tế)
LARAVEL_PATH="/home/user/public_html/ptse"

# Kiểm tra xem thư mục có tồn tại không
if [ ! -d "$LARAVEL_PATH" ]; then
    echo -e "${RED}Lỗi: Thư mục $LARAVEL_PATH không tồn tại!${NC}"
    exit 1
fi

# Di chuyển vào thư mục dự án
cd "$LARAVEL_PATH" || {
    echo -e "${RED}Lỗi: Không thể di chuyển vào $LARAVEL_PATH${NC}"
    exit 1
}

# Kiểm tra xem php có sẵn không
if ! command -v php >/dev/null 2>&1; then
    echo -e "${RED}Lỗi: PHP không được cài đặt hoặc không tìm thấy!${NC}"
    exit 1
fi

echo -e "${GREEN}Bắt đầu làm sạch hệ thống Laravel...${NC}"

# Xóa cache cấu hình
php artisan config:clear
echo -e "${GREEN}Đã xóa cache cấu hình.${NC}"

# Xóa cache ứng dụng
php artisan cache:clear
echo -e "${GREEN}Đã xóa cache ứng dụng.${NC}"

# Xóa cache route
php artisan route:clear
echo -e "${GREEN}Đã xóa cache route.${NC}"

# Xóa cache view
php artisan view:clear
echo -e "${GREEN}Đã xóa cache view.${NC}"

# (Tùy chọn) Tối ưu hóa lại hệ thống
php artisan optimize
echo -e "${GREEN}Đã tối ưu hóa hệ thống.${NC}"

echo -e "${GREEN}Hoàn tất quá trình làm sạch!${NC}"