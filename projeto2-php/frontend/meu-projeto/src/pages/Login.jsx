import React, { useState } from "react";
import { useNavigate } from "react-router-dom";

const Login = () => {
    const [email, setEmail] = useState("");
    const [senha, setSenha] = useState("");
    const navigate = useNavigate();

    const handleLogin = async (e) => {
        e.preventDefault();

        const response = await fetch("http://localhost:5000/public/login.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                email: email,
                senha: senha,
            }),
            credentials: "include", // Enviar cookies de sessão
        });

        const data = await response.json();

        if (data.status === "success") {
            // Redireciona para o main (dashboard) após login bem-sucedido
            navigate("/main");
        } else {
            alert(data.message);
        }
    };

    return (
        <div style={{ textAlign: "center", padding: "50px" }}>
            <h1>Login</h1>
            <form onSubmit={handleLogin}>
                <input
                    type="email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    placeholder="Digite seu email"
                    required
                />
                <br />
                <input
                    type="password"
                    value={senha}
                    onChange={(e) => setSenha(e.target.value)}
                    placeholder="Digite sua senha"
                    required
                />
                <br />
                <button type="submit">Entrar</button>
            </form>
            <br />
            <button onClick={() => navigate("/register")}>Cadastrar-se</button> {/* Botão de cadastro */}
        </div>
    );
};

export default Login;