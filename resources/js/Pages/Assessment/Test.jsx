import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';

export default function Test({ questions = [] }) {
    const [participantName, setParticipantName] = useState('');
    const [answers, setAnswers] = useState({});
    const [isSubmitting, setIsSubmitting] = useState(false);
    const [validationError, setValidationError] = useState('');

    const totalQuestions = questions.length;
    const answeredCount = Object.keys(answers).length;
    const progressPercentage = totalQuestions > 0 ? Math.round((answeredCount / totalQuestions) * 100) : 0;

    const likertOptions = [
        { value: 1, label: 'Sangat Tidak Setuju', short: '1', color: 'hover:border-rose-500/50 hover:bg-rose-500/10' },
        { value: 2, label: 'Tidak Setuju',        short: '2', color: 'hover:border-amber-500/50 hover:bg-amber-500/10' },
        { value: 3, label: 'Netral',              short: '3', color: 'hover:border-slate-500/50 hover:bg-slate-500/10' },
        { value: 4, label: 'Setuju',              short: '4', color: 'hover:border-teal-500/50 hover:bg-teal-500/10' },
        { value: 5, label: 'Sangat Setuju',       short: '5', color: 'hover:border-indigo-500/50 hover:bg-indigo-500/10' },
    ];

    const handleOptionSelect = (questionId, score) => {
        setAnswers((prev) => ({
            ...prev,
            [questionId]: score,
        }));
        if (validationError) {
            setValidationError('');
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        if (!participantName.trim()) {
            setValidationError('Silakan masukkan nama lengkap Anda terlebih dahulu.');
            window.scrollTo({ top: 0, behavior: 'smooth' });
            return;
        }

        const unanswered = questions.filter((q) => !answers[q.id]);
        if (unanswered.length > 0) {
            setValidationError(`Masih ada ${unanswered.length} pertanyaan yang belum dijawab. Mohon lengkapi semua soal.`);
            // Scroll ke soal pertama yang belum dijawab
            const firstUnansweredEl = document.getElementById(`question-${unanswered[0].id}`);
            if (firstUnansweredEl) {
                firstUnansweredEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            return;
        }

        setIsSubmitting(true);
        setValidationError('');

        router.post(
            '/tes/submit',
            {
                participant_name: participantName.trim(),
                answers: answers,
            },
            {
                onError: () => {
                    setIsSubmitting(false);
                    setValidationError('Terjadi kesalahan saat memproses jawaban. Silakan coba lagi.');
                },
                onFinish: () => {
                    setIsSubmitting(false);
                },
            }
        );
    };

    return (
        <>
            <Head title="Asesmen IMT Discovery - Ujian Interaktif" />

            <div className="min-h-screen bg-[#090d16] text-slate-100 selection:bg-indigo-500 selection:text-white relative pb-24">
                
                {/* Background Ambient Glow */}
                <div className="fixed top-0 left-1/2 -translate-x-1/2 w-[45rem] h-96 bg-indigo-900/15 rounded-full blur-[140px] pointer-events-none" />

                {/* Top Navigation */}
                <header className="sticky top-0 z-30 bg-[#090d16]/85 backdrop-blur-xl border-b border-slate-800/80">
                    <div className="max-w-4xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
                        <Link href="/" className="flex items-center space-x-3 group">
                            <div className="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-500 to-fuchsia-500 flex items-center justify-center font-black text-white text-base shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-transform">
                                IMT
                            </div>
                            <span className="text-lg font-bold tracking-tight text-white group-hover:text-indigo-300 transition-colors">
                                Discovery
                            </span>
                        </Link>

                        <div className="flex items-center gap-3">
                            <span className="text-xs font-semibold text-slate-400">
                                {answeredCount} / {totalQuestions} Terjawab
                            </span>
                            <div className="w-24 sm:w-36 h-2.5 bg-slate-800 rounded-full overflow-hidden border border-slate-700/60">
                                <div
                                    className="h-full bg-gradient-to-r from-indigo-500 to-purple-500 transition-all duration-300 rounded-full"
                                    style={{ width: `${progressPercentage}%` }}
                                />
                            </div>
                        </div>
                    </div>
                </header>

                <main className="relative z-10 max-w-3xl mx-auto px-4 sm:px-6 pt-8 sm:pt-12">
                    
                    {/* Header Intro Card */}
                    <div className="bg-slate-900/80 border border-slate-800 rounded-3xl p-6 sm:p-8 backdrop-blur-xl shadow-xl shadow-black/40 mb-8">
                        <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-semibold uppercase tracking-wider mb-4">
                            Instrumen Evaluasi Psikologi
                        </div>
                        <h1 className="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-3">
                            Asesmen IMT Discovery
                        </h1>
                        <p className="text-slate-300 text-sm sm:text-base leading-relaxed mb-6 font-normal">
                            Jawablah setiap pernyataan di bawah ini secara spontan dan jujur sesuai dengan kecenderungan alami diri Anda. Tidak ada jawaban benar maupun salah.
                        </p>

                        {/* Name Input */}
                        <div className="space-y-2">
                            <label htmlFor="participantName" className="block text-xs sm:text-sm font-semibold text-slate-200">
                                Nama Lengkap Peserta <span className="text-rose-400">*</span>
                            </label>
                            <input
                                id="participantName"
                                type="text"
                                value={participantName}
                                onChange={(e) => {
                                    setParticipantName(e.target.value);
                                    if (validationError) setValidationError('');
                                }}
                                placeholder="Masukkan nama lengkap Anda..."
                                className="w-full px-4 py-3.5 rounded-xl bg-slate-950/70 border border-slate-700/80 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all text-sm"
                            />
                        </div>
                    </div>

                    {/* Validation Error Alert */}
                    {validationError && (
                        <div className="mb-6 p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-sm flex items-center gap-3 animate-pulse">
                            <svg className="w-5 h-5 flex-shrink-0 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span>{validationError}</span>
                        </div>
                    )}

                    {/* Questions Form */}
                    <form onSubmit={handleSubmit} className="space-y-6">
                        {questions.map((question, index) => {
                            const isAnswered = !!answers[question.id];
                            const selectedScore = answers[question.id];

                            return (
                                <div
                                    key={question.id}
                                    id={`question-${question.id}`}
                                    className={`bg-slate-900/80 border rounded-3xl p-6 sm:p-8 backdrop-blur-xl transition-all duration-300 ${
                                        isAnswered
                                            ? 'border-slate-800 shadow-lg shadow-black/30'
                                            : 'border-slate-800/80 hover:border-slate-700'
                                    }`}
                                >
                                    {/* Question Meta Header */}
                                    <div className="flex items-center justify-between gap-2 mb-4">
                                        <div className="flex items-center gap-2.5">
                                            <span className="w-7 h-7 rounded-lg bg-indigo-500/20 text-indigo-300 text-xs font-bold flex items-center justify-center border border-indigo-500/30">
                                                {index + 1}
                                            </span>
                                            <span className="text-xs font-semibold text-slate-300">
                                                Pernyataan #{index + 1}
                                            </span>
                                        </div>

                                        {isAnswered ? (
                                            <span className="inline-flex items-center gap-1 text-xs font-medium text-emerald-400">
                                                <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 13l4 4L19 7" />
                                                </svg>
                                                Terisi
                                            </span>
                                        ) : (
                                            <span className="text-xs text-slate-500">
                                                Belum dijawab
                                            </span>
                                        )}
                                    </div>

                                    {/* Question Text */}
                                    <p className="text-base sm:text-lg font-medium text-slate-100 leading-relaxed mb-6">
                                        {question.question_text}
                                    </p>

                                    {/* Likert Scale 5 Options */}
                                    <div className="space-y-3">
                                        {/* Mobile & Desktop Friendly 5 Option Buttons */}
                                        <div className="grid grid-cols-5 gap-2 sm:gap-3">
                                            {likertOptions.map((opt) => {
                                                const isSelected = selectedScore === opt.value;
                                                return (
                                                    <button
                                                        key={opt.value}
                                                        type="button"
                                                        onClick={() => handleOptionSelect(question.id, opt.value)}
                                                        className={`flex flex-col items-center justify-center py-3 sm:py-4 px-1.5 sm:px-2 rounded-2xl border transition-all duration-200 cursor-pointer ${
                                                            isSelected
                                                                ? 'bg-gradient-to-b from-indigo-600 to-purple-600 text-white border-indigo-400 shadow-lg shadow-indigo-500/30 scale-[1.03]'
                                                                : `bg-slate-950/60 border-slate-800 text-slate-300 ${opt.color} hover:text-white`
                                                        }`}
                                                    >
                                                        <span className="text-lg sm:text-2xl font-bold mb-1">
                                                            {opt.value}
                                                        </span>
                                                        <span className="text-[10px] sm:text-xs text-center font-medium leading-tight opacity-90 px-0.5">
                                                            {opt.label}
                                                        </span>
                                                    </button>
                                                );
                                            })}
                                        </div>

                                        {/* Selected Option Feedback Banner */}
                                        {isAnswered && (
                                            <div className="text-center text-xs text-indigo-300 bg-indigo-500/10 border border-indigo-500/20 py-1.5 px-3 rounded-xl font-medium">
                                                Pilihan Anda: <b className="text-white">{selectedScore} — {likertOptions.find(o => o.value === selectedScore)?.label}</b>
                                            </div>
                                        )}
                                    </div>
                                </div>
                            );
                        })}

                        {/* Submit Button Section */}
                        <div className="pt-6">
                            <button
                                type="submit"
                                disabled={isSubmitting}
                                className="w-full py-4 px-8 rounded-2xl bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white font-bold text-lg shadow-xl shadow-indigo-500/25 hover:shadow-indigo-500/40 hover:scale-[1.01] active:scale-[0.99] disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 flex items-center justify-center gap-3"
                            >
                                {isSubmitting ? (
                                    <>
                                        <svg className="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                            <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" />
                                            <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                                        </svg>
                                        <span>Memproses & Menghitung Skor...</span>
                                    </>
                                ) : (
                                    <>
                                        <span>Kirim Jawaban & Lihat Hasil</span>
                                        <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </>
                                )}
                            </button>
                        </div>
                    </form>

                </main>

                {/* Footer */}
                <footer className="max-w-3xl mx-auto px-4 sm:px-6 pt-12 text-center text-xs text-slate-500">
                    &copy; {new Date().getFullYear()} IMT Discovery &bull; Data jawaban Anda dilindungi dan dianalisis secara rahasia.
                </footer>

            </div>
        </>
    );
}
