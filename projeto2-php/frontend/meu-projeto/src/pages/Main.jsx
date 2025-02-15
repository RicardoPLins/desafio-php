import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";

const Main = () => {
    const [user, setUser] = useState(null);
    const navigate = useNavigate();

    useEffect(() => {
        fetch("http://localhost:5000/public/main.php", {
            method: "GET",
            credentials: "include", // Envia cookies de sessão
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === "success") {
                    setUser(data.data); // Armazena os dados do usuário autenticado
                } else {
                    alert(data.message); // Exibe mensagem de erro, caso o usuário não esteja autenticado
                    navigate("/login"); // Redireciona para a página de login
                }
            })
            .catch((error) => {
                console.error("Erro ao buscar dados do usuário:", error);
                alert("Erro ao carregar a página.");
                navigate("/login");
            });
    }, [navigate]);

    const handleLogout = async () => {
        try {
            const response = await fetch("http://localhost:5000/public/logout.php", {
                method: "POST",
                credentials: "include", // Envia cookies de sessão
            });

            const data = await response.json();

            if (data.status === "success") {
                navigate("/"); // Redireciona para a página de login após logout
            } else {
                alert("Erro ao sair: " + data.message);
            }
        } catch (error) {
            console.error("Erro no logout:", error);
            alert("Erro ao processar logout.");
        }
    };

    return (
        <div style={{ textAlign: "center", padding: "50px" }}>
            {user ? (
                <>
                    <h1>Bem-vindo ao Sistema, usuário de email: {user.email}</h1>
                    <button onClick={handleLogout}>Sair</button>
                </>
            ) : (
                <p>Carregando...</p>
            )}
        </div>
    );
};

export default Main;
