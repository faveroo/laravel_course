# 🔐 Laravel Azure SSO - Login Corporativo com Microsoft

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Azure](https://img.shields.io/badge/Microsoft_Azure-0089D6?style=for-the-badge&logo=microsoft-azure&logoColor=white)

Este repositório contém um **micro-projeto de teste** focado na implementação de Autenticação Única (SSO) corporativa. Demonstramos como integrar o **Microsoft Entra ID (antigo Azure AD)** em uma aplicação Laravel utilizando o protocolo **OpenID Connect (OAuth 2.0)** através do **Laravel Socialite**.

---

## 🚀 O que este projeto resolve?

Em ambientes corporativos, a segurança e a experiência do usuário são cruciais. Este projeto demonstra como permitir que colaboradores acessem sistemas internos usando suas contas oficiais da Microsoft, eliminando a necessidade de gerenciar senhas locais e permitindo o uso de políticas de segurança centralizadas (como MFA).

### 📚 Principais Aprendizados:
- **Fluxo OAuth 2.0 / OpenID Connect**: Compreensão prática do handshake entre cliente e provedor.
- **Integração com Azure AD**: Configuração de registros de aplicativos no portal Azure.
- **Laravel Socialite**: Uso de drivers customizados para provedores externos.
- **Gestão de Sessões**: Autenticação de usuários locais a partir de dados externos.

---

## 🧱 Tecnologias Utilizadas

- **Framework**: [Laravel 12+](https://laravel.com)
- **Autenticação**: [Laravel Socialite](https://laravel.com/docs/socialite) + [Microsoft Azure Provider](https://socialiteproviders.com/Microsoft-Azure/)
- **Frontend**: Blade + Tailwind CSS (via Laravel Breeze)
- **Serviço de Identidade**: Microsoft Entra ID (Azure AD)

---

## 🔐 Como funciona o fluxo de login?

O fluxo de autenticação segue o padrão **Authorization Code Grant**:

1.  **Início**: O usuário clica em "Login com Microsoft".
2.  **Redirecionamento**: O Laravel redireciona o usuário para o portal de login da Microsoft.
3.  **Autenticação**: O usuário insere suas credenciais na Microsoft (sujeito a MFA/Políticas da empresa).
4.  **Callback**: A Microsoft envia um código de autorização de volta para o seu site.
5.  **Token**: O Laravel troca esse código por um token de acesso de forma segura (server-to-server).
6.  **Sessão**: O sistema identifica o usuário pelo e-mail, cria ou atualiza o registro local e inicia a sessão.

> [!IMPORTANT]  
> **Segurança em primeiro lugar**: A aplicação **nunca** tem acesso à senha do usuário. Todo o processo de validação de senha ocorre nos servidores da Microsoft.

---

## 🛠️ Instalação e Configuração

### 1. Clonar o repositório
```bash
git clone https://github.com/seu-usuario/laravel-azure-login.git
cd laravel-azure-login
```

### 2. Instalar dependências
```bash
composer install
npm install
```

### 3. Configurar Ambiente
Copie o arquivo `.env.example` e preencha com suas credenciais:
```bash
cp .env.example .env
php artisan key:generate
```

---

## 🔧 Configuração no Portal Azure

Para que o login funcione, você precisa registrar sua aplicação no [Microsoft Entra ID](https://portal.azure.com/):

1.  **App Registrations**: Vá em "Registros de Aplicativo" > "Novo Registro".
2.  **Configurações de Nome**: Nomeie como `Laravel Azure Login`.
3.  **Tipos de conta**: Selecione `Contas em qualquer diretório organizacional` (ou Single Tenant para testes restritos).
4.  **URI de Redirecionamento**:
    -   Tipo: `Web`
    -   URL: `http://localhost:8000/auth/microsoft/callback`
5.  **Segredos do Cliente**: Em "Certificados e Segredos", crie um novo segredo de cliente e copie o **Valor** (não o ID do segredo).

### Variáveis no `.env`
No seu arquivo `.env`, preencha as seguintes chaves obtidas no portal:

```env
AZURE_CLIENT_ID=seu_client_id_aqui
AZURE_CLIENT_SECRET=seu_valor_do_secret_aqui
AZURE_TENANT_ID=seu_tenant_id_aqui
AZURE_REDIRECT_URI=http://localhost:8000/auth/microsoft/callback
```

---

## 🏃‍♂️ Executando o Projeto

1.  **Inicie as migrações** (usando SQLite por padrão):
    ```bash
    php artisan migrate
    ```
2.  **Inicie o servidor de desenvolvimento**:
    ```bash
    php artisan serve
    ```
3.  **Inicie o Vite (Frontend)**:
    ```bash
    npm run dev
    ```

Acesse `http://localhost:8000` e clique no botão de login.

---

## 📁 Estrutura de Código Relevante

-   `config/services.php`: Onde o driver `microsoft` é configurado.
-   `app/Http/Controllers/AuthController.php`: Contém os métodos `auth()` e `callback()` para lidar com o Socialite.
-   `routes/web.php`: Definição das rotas de redirecionamento e retorno.

---

## 📄 Licença

Este projeto está sob a licença [MIT](LICENSE).

---
Desenvolvido como parte do curso de Laravel. 🚀
