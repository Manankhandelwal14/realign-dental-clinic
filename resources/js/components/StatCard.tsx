import { LucideIcon } from 'lucide-react';
import React from 'react';

export interface StatCardProps {
    title: string;
    value: string;
    icon: LucideIcon;
    color?: 'blue' | 'teal' | 'purple' | 'amber' | 'red' | 'green';
    error?: string | null;
}

const StatCard: React.FC<StatCardProps> = ({ title, value, icon: Icon, color = 'blue' }) => {

    const colorClasses = {
        blue: 'bg-blue-50 text-blue-600',
        teal: 'bg-teal-50 text-teal-600',
        purple: 'bg-purple-50 text-purple-600',
        amber: 'bg-amber-50 text-amber-600',
        red: 'bg-red-50 text-red-600',
        green: 'bg-green-50 text-green-600',
    };

    const iconColorClass = colorClasses[color as keyof typeof colorClasses] || colorClasses.blue;

    return (
        <div className={`rounded-xl shadow-sm p-3 transition-all duration-300 hover:shadow-md bg-accent`}>
            <div className="flex items-center">
                <div className={`p-3 border rounded-lg ${iconColorClass}`}>
                    <Icon size={24} />
                </div>
                <div className="ml-5 w-0 flex-1">
                    <dl>
                        <dt className="text-sm font-medium">{title ?? '-'}</dt>
                        <dd>
                            <div className="text-xl font-semibold">{value ?? '-'}</div>
                        </dd>
                    </dl>
                </div>
            </div >
        </div >
    );
};

export default StatCard;