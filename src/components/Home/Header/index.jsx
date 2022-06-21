import React, { useState } from 'react';
import './style.css';

function Header() {

  const [navClass, setNavClass] = useState('');

  const changeNav = () => {
    // set nav class to active when scrolled down
    // set nav class to inactive when scrolled up
    setNavClass(window.scrollY > 0  ? 'active' : '');
  }

  window.addEventListener('scroll', changeNav);

  return (

    <header className={navClass}>
      <nav className='nav container'>
        <a href="#" className='logo'><span>Blog</span>ster </a>
        <a href="#" className='btn-primary'>
          Login
        </a>
      </nav>
    </header>
  )
}

export default Header
