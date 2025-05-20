@extends('layouts.app')

@section('content')
<div class="relative">
    <div class="pt-4 md:pt-[150px]">
        <section class="py-8 md:py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <!-- Header Section -->
                <div class="max-w-3xl mx-auto text-center mb-12 md:mb-20 mt-[150px] md:mt-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Giới thiệu về PTSE</h2>
                    <div class="w-20 h-1 bg-primary mx-auto mb-4 md:mb-6"></div>
                    <p class="text-base md:text-lg text-gray-600">Giải pháp thiết bị cho ngành nước</p>
                </div>

                <!-- Company Overview -->
                <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-center mb-12 md:mb-20">
                    <div class="reveal">
                        <div class="relative">
                            <img
                                src="{{ asset('images/logo_chuan.png') }}"
                                alt="PTSE Company"
                                class="rounded-lg shadow-xl hover:shadow-2xl transition-shadow duration-300 w-full"
                            />
                            <div class="absolute inset-0 bg-primary/10 rounded-lg"></div>
                        </div>
                    </div>
                    <div class="space-y-6 reveal">
                        <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-primary">
                            <h3 class="text-xl md:text-2xl font-bold text-primary mb-4">Về Chúng Tôi</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Công ty Cổ phần Giải pháp Kỹ thuật Phú Thái (Tên giao dịch Quốc tế: PTSE.,JSC), thành lập từ tháng 4 năm 2022, là đơn vị chuyên cung cấp các giải pháp thiết bị công nghệ cao trong lĩnh vực xử lý nước sạch, nước thải và khí thải. Được sáng lập bởi chuyên gia có hơn 17 năm kinh nghiệm trong ngành, PTSE ra đời với sứ mệnh mang đến các giải pháp kỹ thuật tối ưu, đáp ứng yêu cầu đặc thù của từng công trình, hướng tới hiệu quả vận hành và chi phí hợp lý.
                            </p>
                            <p class="text-gray-700 leading-relaxed">
                                Chúng tôi là đối tác phân phối chính thức của nhiều thương hiệu hàng đầu thế giới như Grundfos, +GF+ (Georg Fischer), ALIA, Dorot, AVK, Ebro và ACO… Với danh mục sản phẩm đa dạng, PTSE không chỉ cung cấp thiết bị chất lượng cao mà còn đồng hành cùng khách hàng trong suốt quá trình thiết kế, tích hợp, vận hành và bảo trì hệ thống – đảm bảo hiệu suất ổn định và tuổi thọ dài lâu cho toàn bộ giải pháp.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Mission & Vision Section -->
                <div class="grid md:grid-cols-2 gap-8 mb-12 md:mb-20 reveal">
                    <div class="bg-gradient-to-br from-primary/5 to-primary/10 p-6 rounded-xl">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-bullseye text-primary text-2xl mr-3"></i>
                            <h3 class="text-lg md:text-xl font-bold">Sứ Mệnh</h3>
                        </div>
                        <p class="text-gray-700 leading-relaxed">
                            Lấy "Giải pháp kỹ thuật là trọng tâm" làm kim chỉ nam, PTSE tập trung phát triển dịch vụ tư vấn chuyên sâu, lưu trữ lịch sử thiết bị và nhắc nhở bảo trì định kỳ. Mô hình này giúp khách hàng phòng ngừa rủi ro kỹ thuật, tối ưu hóa chi phí vận hành và đảm bảo tuân thủ các tiêu chuẩn ESG (Môi trường – Xã hội – Quản trị).
                        </p>
                    </div>
                    <div class="bg-gradient-to-br from-primary/5 to-primary/10 p-6 rounded-xl">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-lightbulb text-primary text-2xl mr-3"></i>
                            <h3 class="text-lg md:text-xl font-bold">Tầm Nhìn</h3>
                        </div>
                        <p class="text-gray-700 leading-relaxed">
                            Với tầm nhìn dài hạn, PTSE định hướng trở thành đơn vị tiên phong trong việc cung cấp các giải pháp tổng thể về xử lý nước và môi trường tại Việt Nam – nơi công nghệ, hiệu quả và phát triển bền vững được hội tụ để tạo ra giá trị thiết thực cho cộng đồng và thế hệ tương lai.
                        </p>
                    </div>
                </div>

                <!-- Partners Section -->
                <div class="text-center mb-12 md:mb-20 reveal">
                    <x-home.partners/>
                </div>

                <!-- Commitment Section -->
                <div class="bg-white p-8 rounded-xl shadow-lg reveal border-t-4 border-primary">
                    <div class="max-w-3xl mx-auto text-center">
                        <div class="inline-block p-3 bg-primary/10 rounded-full mb-6">
                            <i class="fas fa-handshake text-primary text-2xl"></i>
                        </div>
                        <h3 class="text-xl md:text-2xl font-bold mb-6">Cam Kết Của Chúng Tôi</h3>
                        <p class="text-gray-700 leading-relaxed mb-6">
                            Chúng tôi cam kết xây dựng văn hóa doanh nghiệp dựa trên sự chuyên nghiệp, đổi mới và trách nhiệm. PTSE không ngừng mở rộng hợp tác với các đối tác trong và ngoài nước nhằm kiến tạo những giá trị bền vững – góp phần xây dựng hệ thống hạ tầng môi trường xanh, hiện đại và phát triển lâu dài.
                        </p>
                        <div class="inline-block bg-primary text-white px-6 py-3 rounded-full font-semibold">
                            PTSE – Giải pháp thiết bị tối ưu, đồng hành vì tương lai bền vững!
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
