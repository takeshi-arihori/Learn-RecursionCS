import React, { createContext, useState, ReactNode } from "react";

interface AdminFlagContextType {
    isAdmin: boolean;
    setIsAdmin: React.Dispatch<React.SetStateAction<boolean>>;
}

export const AdminFlagContext = createContext<AdminFlagContextType | undefined>(undefined);

interface AdminFlagProviderProps {
    children: ReactNode;
}

export const AdminFlagProvider: React.FC<AdminFlagProviderProps> = ({ children }) => {
    const [isAdmin, setIsAdmin] = useState(false);

    return (
        <AdminFlagContext.Provider value={{ isAdmin, setIsAdmin }}>
            {children}
        </AdminFlagContext.Provider>
    );
};
