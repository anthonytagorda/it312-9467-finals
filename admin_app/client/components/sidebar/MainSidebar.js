import Image from 'next/image'
import Link from 'next/link'
import { useEffect, useState } from 'react';

// styles
import styles from '../../styles/Home.module.css'
import mainsidebar from '../../styles/sidebar/mainsidebar.module.css'

// components

// assets
import rty_logo from '../../public/logo/rentify-logo.svg'

export default function MainSidebar() {
    return (
        <div className={mainsidebar.sidebar}>
            <nav className={mainsidebar.sidebar_nav}>
                <ul className={mainsidebar.sidebar_navlinks}>
                    <li>
                        <Link href='/dashboard'>
                            <div className={mainsidebar.sidebar_link_div}>
                                <div className={mainsidebar.sidebar_link_icon}>
                                    
                                </div>
                                <div className={mainsidebar.sidebar_link_desc}>
                                    <p className={mainsidebar.sidebar_link}>
                                        Dashboard
                                    </p>
                                </div>
                            </div>
                        </Link>
                    </li>

                    <li>
                        <Link href='/'>
                            <div className={mainsidebar.sidebar_link_div}>
                                <div className={mainsidebar.sidebar_link_icon}>
                                    
                                </div>
                                <div className={mainsidebar.sidebar_link_desc}>
                                    <p className={mainsidebar.sidebar_link}>
                                        Rooms
                                    </p>
                                </div>
                            </div>
                        </Link>
                    </li>

                    <li>
                        <Link href='/'>
                            <div className={mainsidebar.sidebar_link_div}>
                                <div className={mainsidebar.sidebar_link_icon}>
                                    
                                </div>
                                <div className={mainsidebar.sidebar_link_desc}>
                                    <p className={mainsidebar.sidebar_link}>
                                        Equipments
                                    </p>
                                </div>
                            </div>
                        </Link>
                    </li>

                    <li>
                        <Link href='/'>
                            <div className={mainsidebar.sidebar_link_div}>
                                <div className={mainsidebar.sidebar_link_icon}>
                                    
                                </div>
                                <div className={mainsidebar.sidebar_link_desc}>
                                    <p className={mainsidebar.sidebar_link}>
                                        Transaction History
                                    </p>
                                </div>
                            </div>
                        </Link>
                    </li>

                    <li>
                        <Link href='/'>
                            <div className={mainsidebar.sidebar_link_div}>
                                <div className={mainsidebar.sidebar_link_icon}>
                                    
                                </div>
                                <div className={mainsidebar.sidebar_link_desc}>
                                    <p className={mainsidebar.sidebar_link}>
                                        Accounts
                                    </p>
                                </div>
                            </div>
                        </Link>
                    </li>


                </ul>
            </nav>

            <div className={mainsidebar.sidebar_report_div}>
                <Link href='/'>
                    <div className={mainsidebar.sidebar_report_link_div}>
                        <div className={mainsidebar.sidebar_report_link_icon}>
                                    
                        </div>
                        <div className={mainsidebar.sidebar_report_link_desc}>
                            <p className={mainsidebar.sidebar_report_link}>
                                Report
                            </p>
                        </div>
                    </div>
                </Link>
            </div>
        </div>
    )
}