@extends('layouts.app')

@section('content')
<div class="relative">
    <div class="pt-4 md:pt-[150px]">
        <section class="py-8 md:py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <!-- Header Section -->
                <div class="max-w-3xl mx-auto text-center mb-12 md:mb-20 mt-[150px] md:mt-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                        @if(app()->getLocale() == 'vi')
                            Giới thiệu về PTSE
                        @else
                            About PTSE
                        @endif
                    </h2>
                    <div class="w-20 h-1 bg-primary mx-auto mb-4 md:mb-6"></div>
                    <p class="text-base md:text-lg text-gray-600">
                        @if(app()->getLocale() == 'vi')
                            Giải pháp thiết bị cho ngành nước
                        @else
                            Equipment solutions for the water industry
                        @endif
                    </p>
                </div>

                <!-- Company Overview -->
                @if(isset($introduces['about']) && isset($introduces['about'][0]))
                <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-center mb-12 md:mb-20">
                    <div class="reveal">
                        <div class="relative">
                            <img
                                src="{{ asset('images/logo_chuan.png') }}"
                                alt="PTSE Company"
                                class="duration-300 w-full"
                            />
                            <div class="absolute inset-0 "></div>
                        </div>
                    </div>
                    <div class="space-y-6 reveal">
                        <div class="bg-white p-6 rounded-xl shadow-lg border-l-4 border-primary">
                            <h3 class="text-xl md:text-2xl font-bold text-primary mb-4">
                                @if(app()->getLocale() == 'vi')
                                    Về Chúng Tôi
                                @else
                                    About Us
                                @endif
                            </h3>
                            <p class="text-gray-700 leading-relaxed">
                                {{-- @if(app()->getLocale() == 'vi')
                                    Công ty Cổ phần Giải pháp Kỹ thuật Phú Thái (Tên giao dịch Quốc tế: PTSE.,JSC), thành lập từ tháng 4 năm 2022, là đơn vị chuyên cung cấp các giải pháp thiết bị công nghệ cao trong lĩnh vực xử lý nước sạch, nước thải và khí thải. Được sáng lập bởi chuyên gia có hơn 17 năm kinh nghiệm trong ngành, PTSE ra đời với sứ mệnh mang đến các giải pháp kỹ thuật tối ưu, đáp ứng yêu cầu đặc thù của từng công trình, hướng tới hiệu quả vận hành và chi phí hợp lý.
                                @else
                                    Phu Thai Technical Solutions Joint Stock Company (International Trading Name: PTSE.,JSC), established in April 2022, is a unit specializing in providing high-tech equipment solutions in the field of clean water, wastewater and exhaust gas treatment. Founded by experts with more than 17 years of experience in the industry, PTSE was born with the mission of providing optimal technical solutions, meeting the specific requirements of each project, aiming for operational efficiency and reasonable costs.
                                @endif --}}
                                {!! $introduces['about'][0]->content !!}
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                <!-- Mission & Vision Section -->
                <div class="grid md:grid-cols-2 gap-8 mb-12 md:mb-20 reveal">
                    @if(isset($introduces['mission']) && isset($introduces['mission'][0]))
                        <div class="bg-gradient-to-br from-primary/5 to-primary/10 p-6 rounded-xl">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-bullseye text-primary text-2xl mr-3"></i>
                            <h3 class="text-lg md:text-xl font-bold">
                                @if(app()->getLocale() == 'vi')
                                    Sứ Mệnh
                                @else
                                    Mission
                                @endif
                            </h3>
                        </div>
                        <p class="text-gray-700 leading-relaxed">
                            {{-- @if(app()->getLocale() == 'vi')
                                Lấy "Giải pháp kỹ thuật là trọng tâm" làm kim chỉ nam, PTSE tập trung phát triển dịch vụ tư vấn chuyên sâu, lưu trữ lịch sử thiết bị và nhắc nhở bảo trì định kỳ. Mô hình này giúp khách hàng phòng ngừa rủi ro kỹ thuật, tối ưu hóa chi phí vận hành và đảm bảo tuân thủ các tiêu chuẩn ESG (Môi trường – Xã hội – Quản trị).
                            @else
                                With "Technical solutions at the core" as a guiding principle, PTSE focuses on developing in-depth consulting services, equipment history storage and periodic maintenance reminders. This model helps customers prevent technical risks, optimize operating costs and ensure compliance with ESG (Environmental – Social – Governance) standards.
                            @endif --}}
                                {!! $introduces['mission'][0]->content !!}
                            </p>
                        </div>
                    @endif
                    @if(isset($introduces['vision']) && isset($introduces['vision'][0]))
                        <div class="bg-gradient-to-br from-primary/5 to-primary/10 p-6 rounded-xl">
                            <div class="flex items-center mb-4">
                                <i class="fas fa-lightbulb text-primary text-2xl mr-3"></i>
                                <h3 class="text-lg md:text-xl font-bold">
                                    @if(app()->getLocale() == 'vi')
                                        Tầm Nhìn
                                    @else
                                        Vision
                                    @endif
                                </h3>
                            </div>
                            <p class="text-gray-700 leading-relaxed">
                                {{-- @if(app()->getLocale() == 'vi')
                                    Với tầm nhìn dài hạn, PTSE định hướng trở thành đơn vị tiên phong trong việc cung cấp các giải pháp tổng thể về xử lý nước và môi trường tại Việt Nam – nơi công nghệ, hiệu quả và phát triển bền vững được hội tụ để tạo ra giá trị thiết thực cho cộng đồng và thế hệ tương lai.
                                @else
                                    With a long-term vision, PTSE aims to become a pioneer in providing comprehensive solutions for water and environmental treatment in Vietnam - where technology, efficiency and sustainable development converge to create practical values ​​for the community and future generations.
                                @endif --}}
                                {!! $introduces['vision'][0]->content !!}
                            </p>
                        </div>
                    @endif
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
                        <h3 class="text-xl md:text-2xl font-bold mb-6">
                            @if(app()->getLocale() == 'vi')
                                Cam Kết Của Chúng Tôi
                            @else
                                Our Commitment
                            @endif
                        </h3>
                        <p class="text-gray-700 leading-relaxed mb-6">
                            @if(app()->getLocale() == 'vi')
                                Chúng tôi cam kết xây dựng văn hóa doanh nghiệp dựa trên sự chuyên nghiệp, đổi mới và trách nhiệm. PTSE không ngừng mở rộng hợp tác với các đối tác trong và ngoài nước nhằm kiến tạo những giá trị bền vững – góp phần xây dựng hệ thống hạ tầng môi trường xanh, hiện đại và phát triển lâu dài.
                            @else
                            We are committed to building a corporate culture based on professionalism, innovation and responsibility. PTSE constantly expands cooperation with domestic and foreign partners to create sustainable values ​​- contributing to the construction of a green, modern and sustainable environmental infrastructure system.
                            @endif
                        </p>
                        <div class="inline-block bg-primary text-white px-6 py-3 rounded-full font-semibold">
                            @if(app()->getLocale() == 'vi')
                                PTSE – Giải pháp thiết bị tối ưu, đồng hành vì tương lai bền vững!
                            @else
                                PTSE – Optimal equipment solutions, accompanying for a sustainable future!
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
