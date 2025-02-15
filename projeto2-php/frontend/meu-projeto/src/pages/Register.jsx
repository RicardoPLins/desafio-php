import React, { useState } from "react";
import { useNavigate } from "react-router-dom";

const Register = () => {
    const [email, setEmail] = useState("");
    const [senha, setSenha] = useState("");
    const navigate = useNavigate();

    const handleRegister = async (e) => {
        e.preventDefault();
        console.log("Botão de cadastro clicado!"); // Verifique no console

        try {
            const response = await fetch("http://localhost:5000/public/register.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ email, senha }),
            });

            const data = await response.json();
            if (data.status === "success") {
                alert("Cadastro realizado! Faça login.");
                navigate("/"); // Redireciona para o login
            } else {
                alert(data.message); // Exibe mensagem de erro
            }
        } catch (error) {
            alert("Erro ao conectar com o servidor.");
        }
    };

    return (
        <div>
            <h1>Cadastro</h1>
            <form onSubmit={handleRegister}>
                <input
                    type="email"
                    placeholder="E-mail"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    required
                />
                <input
                    type="password"
                    placeholder="Senha"
                    value={senha}
                    onChange={(e) => setSenha(e.target.value)}
                    required
                />
                <button type="submit">Cadastrar</button>
            </form>
            <p>
                Já tem uma conta? <a href="/">Faça login</a>
            </p>
        </div>
    );
};

export default Register;
