import React from 'react';
import { Head, Link } from '@inertiajs/react';


export default function Results({ users }) {
    return (
        <>
            <Head title="Hasil Asesmen Peserta - IMT Discovery" />

            <div className="min-h-screen bg-[#090d16] text-slate-100 selection:bg-indigo-500 selection:text-white relative overflow-hidden flex flex-col">
                
                {/* Background Glow Blobs */}
                <div className="absolute top-0 left-1/4 w-96 h-96 bg-indigo-600/15 rounded-full blur-3xl pointer-events-none" />
                <div className="absolute top-1/3 right-1/4 w-[30rem] h-[30rem] bg-purple-600/10 rounded-full blur-3xl pointer-events-none" />
                <div className="absolute bottom-10 left-1/3 w-80 h-80 bg-pink-600/10 rounded-full blur-3xl pointer-events-none" />

                {/* Navigation Header */}
                <header className="relative z-10 max-w-7xl mx-auto w-full px-6 py-8 flex items-center justify-between">
                    <Link href="/" className="flex items-center space-x-3 group">
                        <div className="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 to-fuchsia-500 flex items-center justify-center font-black text-white text-xl shadow-lg shadow-indigo-500/30 group-hover:scale-105 transition-transform">
                            IMT
                        </div>
                        <span className="text-xl font-bold tracking-tight text-white group-hover:text-indigo-300 transition-colors">
                            Discovery
                        </span>
                    </Link>

                    <div>
                        <Link href="/tes" className="text-sm font-semibold px-4 py-2 rounded-full bg-white/5 hover:bg-white/10 text-slate-300 border border-white/10 transition-colors">
                            Mulai Asesmen
                        </Link>
                    </div>
                </header>

                <main className="relative z-10 max-w-7xl mx-auto w-full px-6 py-8 flex-1 flex flex-col">
                    <div className="mb-10 text-center sm:text-left">
                        <h1 className="text-3xl sm:text-4xl font-extrabold tracking-tight text-white mb-2">
                            Hasil Peserta
                        </h1>
                        <p className="text-slate-400">
                            Daftar seluruh peserta yang telah menyelesaikan asesmen IMT Discovery.
                        </p>
                    </div>

                    <div className="bg-slate-900/60 backdrop-blur-xl border border-white/5 rounded-3xl overflow-hidden shadow-2xl">
                        <div className="overflow-x-auto">
                            <table className="w-full text-left text-sm text-slate-300">
                                <thead className="bg-white/5 text-xs uppercase text-slate-400 border-b border-white/10">
                                    <tr>
                                        <th scope="col" className="px-6 py-4 font-semibold rounded-tl-3xl">Tanggal</th>
                                        <th scope="col" className="px-6 py-4 font-semibold">Nama Peserta</th>
                                        <th scope="col" className="px-6 py-4 font-semibold">Archetype Dominan</th>
                                        <th scope="col" className="px-6 py-4 font-semibold text-center">Security</th>
                                        <th scope="col" className="px-6 py-4 font-semibold text-center">Significance</th>
                                        <th scope="col" className="px-6 py-4 font-semibold text-center">Connection</th>
                                        <th scope="col" className="px-6 py-4 font-semibold text-center">Growth</th>
                                        <th scope="col" className="px-6 py-4 font-semibold text-center">Contribution</th>
                                        <th scope="col" className="px-6 py-4 font-semibold text-right rounded-tr-3xl">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody className="divide-y divide-white/5">
                                    {users.length === 0 ? (
                                        <tr>
                                            <td colSpan="9" className="px-6 py-12 text-center text-slate-500">
                                                Belum ada peserta yang menyelesaikan asesmen.
                                            </td>
                                        </tr>
                                    ) : (
                                        users.map((user) => (
                                            <tr key={user.id} className="hover:bg-white/5 transition-colors group">
                                                <td className="px-6 py-4 whitespace-nowrap text-slate-400">
                                                    {new Date(user.created_at).toLocaleDateString('id-ID', {
                                                        day: '2-digit',
                                                        month: 'short',
                                                        year: 'numeric',
                                                        hour: '2-digit',
                                                        minute: '2-digit'
                                                    })}
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap font-medium text-white">
                                                    {user.name}
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap">
                                                    <span className="px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                                                        {user.archetype_name || 'Menunggu Analisis'}
                                                    </span>
                                                </td>
                                                <td className="px-6 py-4 text-center">
                                                    <div className="font-semibold text-blue-400">{user.security_score}%</div>
                                                </td>
                                                <td className="px-6 py-4 text-center">
                                                    <div className="font-semibold text-amber-400">{user.significance_score}%</div>
                                                </td>
                                                <td className="px-6 py-4 text-center">
                                                    <div className="font-semibold text-pink-400">{user.connection_score}%</div>
                                                </td>
                                                <td className="px-6 py-4 text-center">
                                                    <div className="font-semibold text-emerald-400">{user.growth_score}%</div>
                                                </td>
                                                <td className="px-6 py-4 text-center">
                                                    <div className="font-semibold text-purple-400">{user.contribution_score}%</div>
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap text-right">
                                                    <a 
                                                        href={`/laporan/${user.id}`} 
                                                        className="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-white bg-indigo-600/80 hover:bg-indigo-500 rounded-lg transition-colors"
                                                    >
                                                        Lihat Laporan
                                                        <svg className="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </a>
                                                </td>
                                            </tr>
                                        ))
                                    )}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>

                <footer className="relative z-10 max-w-7xl mx-auto w-full px-6 py-6 border-t border-white/5 text-center text-xs text-slate-500 mt-auto">
                    &copy; {new Date().getFullYear()} IMT Discovery &bull; Powered by Laravel, Inertia.js & React
                </footer>
            </div>
        </>
    );
}
