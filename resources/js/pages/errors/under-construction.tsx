import React, { useEffect, useState } from "react";

const App: React.FC = () => {
    const [text, setText] = useState<string>("");
    const fullText = "Align. Smile. Shine! ✨";
    useEffect(() => {
        let index = 0;
        const typeWriter = setInterval(() => {
            if (index < fullText.length) {
                setText((prev) => prev + fullText.charAt(index));
                index++;
            } else {
                clearInterval(typeWriter);
            }
        }, 100);
        return () => clearInterval(typeWriter);
    }, []);
    return (
        <div className="min-h-screen bg-gradient-to-b from-blue-50 to-white">
            <div className="max-w-[1440px] mx-auto min-h-[1024px] px-8 py-12">
                <div className="flex flex-col items-center justify-center space-y-12">
                    {/* Logo Section */}
                    <div className="animate-fade-in">
                        <img
                            src="/images/logo/logo-png.png"
                            alt="Realign Dental Clinic Logo"
                            className="w-40 h-40 object-contain"
                        />
                    </div>
                    {/* Main Content */}
                    <div className="text-center space-y-6 animate-slide-up">
                        <h1 className="text-5xl font-bold text-[#C6A962] mb-2">
                            Realign Dental Clinic
                        </h1>
                        <h2 className="text-3xl font-semibold text-gray-700">
                            Website Under Construction
                        </h2>
                        <p className="text-2xl text-blue-600 font-light tracking-wide">
                            {text}
                        </p>
                    </div>
                    {/* Contact Information */}
                    <div className="space-y-4">
                        <h2 className="text-2xl font-bold text-blue-700 mb-6">
                            Contact Us
                        </h2>
                        <div className="flex items-center space-x-3 hover:text-blue-600 transition-colors cursor-pointer text-gray-600 group">
                            <i className="fas fa-phone-alt text-blue-500 group-hover:text-blue-600 transition-colors"></i>
                            <p>+91 7891012206</p>
                        </div>
                    </div>
                    {/* Footer */}
                    <footer className="mt-12 text-center text-gray-600">
                        <p>© 2024 Realign Dental Clinic. All rights reserved.</p>
                    </footer>
                </div>
            </div>
        </div>
    );
};
export default App;