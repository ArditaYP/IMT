import React from 'react';
import { Head, Link } from '@inertiajs/react';

export default function Welcome() {
    const drivers = [
        {
            title: 'Security',
            subtitle: 'Kepastian & Perlindungan',
            desc: 'Kebutuhan mendasar akan stabilitas, kenyamanan, dan rasa aman.',
            color: 'from-blue-500/20 to-cyan-500/10',
            border: 'border-blue-500/30',
            textColor: 'text-blue-400',
            icon: '🛡️',
        },
        {
            title: 'Significance',
            subtitle: 'Arti Penting & Pengakuan',
            desc: 'Dorongan untuk merasa berharga, unik, dan memiliki peran penting.',
            color: 'from-amber-500/20 to-yellow-500/10',
            border: 'border-amber-500/30',
            textColor: 'text-amber-400',
            icon: '⭐',
        },
        {
            title: 'Connection',
            subtitle: 'Kedekatan & Relasi',
            desc: 'Kebutuhan mendalam akan kebersamaan, rasa cinta, dan keterikatan.',
            color: 'from-pink-500/20 to-rose-500/10',
            border: 'border-pink-500/30',
            textColor: 'text-pink-400',
            icon: '❤️',
        },
        {
            title: 'Growth',
            subtitle: 'Pertumbuhan & Kapasitas',
            desc: 'Dorongan konstan untuk belajar, berkembang, dan menembus batas diri.',
            color: 'from-emerald-500/20 to-teal-500/10',
            border: 'border-emerald-500/30',
            textColor: 'text-emerald-400',
            icon: '🌱',
        },
        {
            title: 'Contribution',
            subtitle: 'Kontribusi & Dampak',
            desc: 'Keinginan melampaui diri sendiri untuk memberi manfaat bagi orang lain.',
            color: 'from-purple-500/20 to-indigo-500/10',
            border: 'border-purple-500/30',
            textColor: 'text-purple-400',
            icon: '🤝',
        },
    ];

    return (
        <>
            <Head title="IMT Discovery - Asesmen 5 Human Drivers" />

            <div className="min-h-screen bg-[#090d16] text-slate-100 selection:bg-indigo-500 selection:text-white relative overflow-hidden flex flex-col justify-between">
                
                {/* Background Glow Blobs */}
                <div className="absolute top-0 left-1/4 w-96 h-96 bg-indigo-600/15 rounded-full blur-3xl pointer-events-none" />
                <div className="absolute top-1/3 right-1/4 w-[30rem] h-[30rem] bg-purple-600/10 rounded-full blur-3xl pointer-events-none" />
                <div className="absolute bottom-10 left-1/3 w-80 h-80 bg-pink-600/10 rounded-full blur-3xl pointer-events-none" />

                {/* Navigation Header */}
                <header className="relative z-10 max-w-7xl mx-auto w-full px-6 py-8 flex items-center justify-between">
                    <div className="flex items-center space-x-3">
                        <div className="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 to-fuchsia-500 flex items-center justify-center font-black text-white text-xl shadow-lg shadow-indigo-500/30">
                            IMT
                        </div>
                        <span className="text-xl font-bold tracking-tight text-white">
                            Discovery
                        </span>
                    </div>

                    <div>
                        <span className="text-xs font-semibold px-3 py-1.5 rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 tracking-wide uppercase">
                            AI Psychology Profiling
                        </span>
                    </div>
                </header>

                {/* Hero Section */}
                <main className="relative z-10 max-w-5xl mx-auto px-6 py-12 text-center flex-1 flex flex-col items-center justify-center">
                    
                    {/* Badge */}
                    <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 text-slate-300 text-sm font-medium mb-8 backdrop-blur-md">
                        <span className="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Asesmen Psikologi 5 Human Drivers
                    </div>

                    {/* Headline */}
                    <h1 className="text-5xl sm:text-6xl md:text-7xl font-extrabold tracking-tight text-white mb-6 leading-tight">
                        Temukan Kompas Diri di <br className="hidden sm:block" />
                        <span className="bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                            IMT Discovery
                        </span>
                    </h1>

                    {/* Subtitle */}
                    <p className="text-lg sm:text-xl text-slate-300 max-w-2xl mx-auto mb-10 leading-relaxed font-normal">
                        Pahami 5 dorongan psikologis utama Anda — Security, Significance, Connection, Growth, dan Contribution — beserta Archetype kepribadian Anda dengan analisis berbasis AI.
                    </p>

                    {/* CTA Button */}
                    <div className="flex flex-col sm:flex-row items-center gap-4 justify-center mb-16 w-full max-w-md">
                        <Link
                            href="/tes"
                            className="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white font-bold text-lg shadow-xl shadow-indigo-500/25 hover:shadow-indigo-500/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-3 group"
                        >
                            <span>Mulai Tes</span>
                            <svg className="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </Link>
                    </div>

                    {/* 5 Drivers Cards Grid */}
                    <div className="w-full grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 text-left">
                        {drivers.map((driver) => (
                            <div
                                key={driver.title}
                                className={`bg-gradient-to-b ${driver.color} bg-slate-900/60 backdrop-blur-xl border ${driver.border} p-5 rounded-2xl transition-all duration-300 hover:-translate-y-1 hover:shadow-lg`}
                            >
                                <div className="text-2xl mb-3">{driver.icon}</div>
                                <h3 className={`font-bold text-base ${driver.textColor} mb-1`}>
                                    {driver.title}
                                </h3>
                                <div className="text-xs font-semibold text-slate-400 mb-2">
                                    {driver.subtitle}
                                </div>
                                <p className="text-xs text-slate-300/80 leading-relaxed">
                                    {driver.desc}
                                </p>
                            </div>
                        ))}
                    </div>
                </main>

                {/* Footer */}
                <footer className="relative z-10 max-w-7xl mx-auto w-full px-6 py-6 border-t border-white/5 text-center text-xs text-slate-500">
                    &copy; {new Date().getFullYear()} IMT Discovery &bull; Powered by Laravel, Inertia.js & React
                </footer>

            </div>
        </>
    );
}
