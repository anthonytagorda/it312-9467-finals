import Image from 'next/image'
import Link from 'next/link'
import { useEffect, useState } from 'react';

// styles
import styles from '../../styles/Home.module.css'
import mainheader from '../../styles/header/mainheader.module.css'

// components

// assets
import rty_logo from '../../public/logo/rentify-logo.svg'

export default function MainHeader() {
    return (
        <header className={mainheader.header}>
            <div className={mainheader.header_logo_container}>
                <Image src={rty_logo} alt='Rentify Logo' height={50} />
            </div>

            
        </header>
    )
}