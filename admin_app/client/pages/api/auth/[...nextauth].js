import NextAuth from 'next-auth';
import Providers from 'next-auth/providers';

export default NextAuth({
    providers: [
        // Custom Database Provider
        Providers.Credentials({
            
        })
    ]
})